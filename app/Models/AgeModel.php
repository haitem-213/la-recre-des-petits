<?php namespace App\Models;

use CodeIgniter\Model;

class AgeModel extends Model
{
    protected $table = 'age';               // Nom de la table : 'age'
    protected $primaryKey = 'id_age';       // Clé primaire : 'id_age'
    protected $useAutoIncrement = true;     // Auto-incrémentation activée
    protected $allowedFields = ['noma'];    // Champs autorisés pour les opérations d'insertion/mise à jour

    public function ajouterAge(array $donnees): bool
{
    try {
        return $this->insert($donnees);
    } catch (\Exception $e) {
        log_message('error', 'Erreur lors de l\'ajout de l\'âge : ' . $e->getMessage());
        return false;
    }
}

    

    // Récupère tous les enregistrements d'âge dans la table
    public function listeTousLesAges()
    {
        return $this->findAll();
    }

    // Récupère un enregistrement d'âge spécifique par son id_age
    public function obtenirUnAge(int $idAge): ?object
    {
        $resultat = $this->where('id_age', $idAge)->first();
        return $resultat ? (object) $resultat : null;
    }

    // Supprime un enregistrement d'âge spécifique par son id_age
    public function supprimerAge(int $idAge): bool
    {
        if ($this->find($idAge) === null) {
            return false;
        }
        return $this->delete($idAge);
    }

    // Met à jour un enregistrement d'âge spécifique par son id_age
    public function mettreAJourAge(int $id_age, array $donnees): bool
    {
        try {
            return $this->update($id_age, $donnees); 
        } catch (\Exception $e) {
            log_message('error', 'Erreur lors de la mise à jour de l\'âge: ' . $e->getMessage());
            return false;
        }
    }
    

    
}
