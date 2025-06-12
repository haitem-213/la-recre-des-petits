<?php

namespace App\Models;

use CodeIgniter\Model;

class CommandeModel extends Model {

    protected $table = 'commande';
    protected $primaryKey = 'id_commande';
    protected $allowedFields = ['utilisateur_id', 'statut', 'totalc'];
    protected $useSoftDeletes = false; 
    protected $returnType = 'array';

  
    // protected $validationRules = [
    //     'utilisateur_id' => 'required|integer',
    //     'date_de_commande' => 'required|valid_date[Y-m-d H:i:s]',
    //     'statut' => 'required|in_list[En attente,En cours,Livré,Annulé]',
    //     'totalc' => 'required|decimal'
    // ];

    // protected $validationMessages = [
    //     'utilisateur_id' => [
    //         'required' => 'L\'ID utilisateur est requis.',
    //         'integer' => 'L\'ID utilisateur doit être un entier valide.'
    //     ],
    //     'date_de_commande' => [
    //         'required' => 'La date de commande est obligatoire.',
    //         'valid_date' => 'Veuillez fournir une date valide au format Y-m-d H:i:s.'
    //     ],
    //     'statut' => [
    //         'required' => 'Le statut est requis.',
    //         'in_list' => 'Le statut doit être l\'un des suivants : En attente, En cours, Livré, Annulé.'
    //     ],
    //     'totalc' => [
    //         'required' => 'Le total est requis.',
    //         'decimal' => 'Le total doit être un nombre décimal valide.'
    //     ]
    // ];

 
    public function getEnAttenteCommandes() {
        return $this->where('statut', 'En attente')->findAll();
    }

    public function getByUtilisateur($utilisateur_id) {
        return $this->where('utilisateur_id', $utilisateur_id)->findAll();
    }

 
    public function getCommandesByDateRange($startDate, $endDate) {
        return $this->where('date_de_commande >=', $startDate)
                    ->where('date_de_commande <=', $endDate)
                    ->findAll();
    }


    public function updateCommandeStatus($id_commande, $newStatus) {
        if (!in_array($newStatus, ['En attente', 'En cours', 'Livré', 'Annulé'])) {
            throw new \InvalidArgumentException('Le statut spécifié n\'est pas valide.');
        }
        return $this->update($id_commande, ['statut' => $newStatus]);
    }


    public function getTotalAmount() {
        return $this->selectSum('totalc')->where('statut !=', 'Annulé')->get()->getRow()->totalc;
    }

    public function creerCommande(int $utilisateur_id, float $prix_total, string $statut) : int
    {
        $data = [
            'utilisateur_id' => $utilisateur_id,
            'totalc' => $prix_total,
            'statut' => $statut, // Statut initial
        ];

        return $this->insert($data);
    }
}
