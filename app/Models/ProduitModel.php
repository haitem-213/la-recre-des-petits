<?php namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table = 'produits'; 
    protected $primaryKey = 'id_produit'; 
    protected $useAutoIncrement = true; 
    protected $allowedFields = ['id_produit', 'nomp', 'description', 'prix', 'stock', 'image', 'categorie_id', 'age_id', 'marque_id', 'date_de_creation']; 
    protected $returnType = 'object'; 


    // public function listeTousLesProduits(): array
    // {
    //     return $this->select('id_produit, nomp, description, prix, stock, image, categorie_id, age_id, marque_id, date_de_creation')->get()->getResult();
    
    // }
    public function listeTousLesProduits()
    {
        return $this->db->query("
            SELECT id_produit, nomp, description, prix, stock, image, categorie_id, age_id, marque_id, date_de_creation
            FROM produits;
        ")->getResult();
    }
    
    

    public function obtenirUnProduit(int $idproduit): ?object
    {
        return $this->find($idproduit);
    }
    

    public function ajouterProduit(array $data): bool
    {
        try {
            return $this->insert($data) !== false;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }


    // Déclaration de la méthode pour mettre à jour un produit
public function mettreAJourProduit(int $idproduit, array $data): bool
{
    // Début du bloc try pour capturer les exceptions
    try {
        // Vérification de l'existence de la catégorie si elle est fournie dans les données
        if (isset($data['categorie_id'])) {
            // Compte le nombre de catégories avec l'ID spécifié
            $categorieExists = $this->db->table('categorie')
                ->where('id_categorie', $data['categorie_id'])
                // Cette ligne est utilisée dans le Query Builder de CodeIgniter 4 pour vérifier 
                //  si au moins un enregistrement existe dans une table selon des conditions données.
                //Convertit le résultat en booléen :
                //Si count > 0 → true (l'enregistrement existe).
                //Si count = 0 → false (l'enregistrement n'existe pas).
                ->countAllResults() > 0;
            
            // Si la catégorie n'existe pas, lance une exception
            if (!$categorieExists) {
                // Cette ligne de code lève une exception (génère une erreur contrôlée) 
                //lorsque la catégorie demandée n'existe pas en base de données.
                throw new \RuntimeException('La catégorie spécifiée n\'existe pas');
            }
        }

        // Vérification de l'existence de la tranche d'âge si elle est fournie
        if (isset($data['age_id'])) {
            // Compte le nombre de tranches d'âge avec l'ID spécifié
            $ageExists = $this->db->table('age')
                ->where('id_age', $data['age_id'])
                ->countAllResults() > 0;
            
            // Si la tranche d'âge n'existe pas, lance une exception
            if (!$ageExists) {
                throw new \RuntimeException('La tranche d\'âge spécifiée n\'existe pas');
            }
        }

        // Vérification de l'existence de la marque si elle est fournie
        if (isset($data['marque_id'])) {
            // Compte le nombre de marques avec l'ID spécifié
            $marqueExists = $this->db->table('marque')
                ->where('id_marque', $data['marque_id'])
                ->countAllResults() > 0;
            
            // Si la marque n'existe pas, lance une exception
            if (!$marqueExists) {
                throw new \RuntimeException('La marque spécifiée n\'existe pas');
            }
        }

        // Préparation de la requête de mise à jour
        $builder = $this->builder(); // Obtient une instance du query builder pour la table produits
        $builder->where('id_produit', $idproduit); // Filtre pour le produit à mettre à jour
        return $builder->update($data); // Exécute la mise à jour et retourne le résultat (true/false)
    
    } catch (\Exception $e) {
        // En cas d'erreur, log l'erreur avec l'ID du produit concerné
        log_message('error', 'Erreur lors de la mise à jour du produit ID ' . $idproduit . ': ' . $e->getMessage());
        return false; // Retourne false pour indiquer l'échec de la mise à jour
    }
}

    
    
    
    public function supprimer($idproduit)
    {
        $result = $this->db->table('produits')->where('id_produit', $idproduit)->delete();
    
        if (!$result) {
            $error = $this->db->error();
           
        }
    
        return $result;
    }
    
    
    
}
