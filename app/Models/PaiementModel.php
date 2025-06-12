<?php

namespace App\Models;

use CodeIgniter\Model;




class PaiementModel extends Model
{
   
   

    protected $table = 'paiement';
    protected $primaryKey = 'paiement_id';
    protected $allowedFields = ['commande_id', 'montant', 'methode', 'statut'];
    protected $returnType = 'array';


    protected $validationRules = [
        'commande_id' => 'required|integer',
        'montant' => 'required|decimal',
        'methode' => 'required|string',
        'statut' => 'required|in_list[En attente,Effectué,Annulé]',
    ];

    protected $validationMessages = [
        'commande_id' => [
            'required' => 'L\'ID de commande est requis.',
            'integer' => 'L\'ID de commande doit être un entier valide.',
        ],
        'montant' => [
            'required' => 'Le montant est requis.',
            'decimal' => 'Le montant doit être un nombre décimal valide.',
        ],
        'methode' => [
            'required' => 'La méthode de paiement est obligatoire.',
            'string' => 'La méthode de paiement doit être une chaîne valide.',
        ],
        'statut' => [
            'required' => 'Le statut est requis.',
            'in_list' => 'Le statut doit être l\'un des suivants : En attente, Effectué, Annulé.',
        ],
    ];

    public function getByCommande($commande_id)
    {
        return $this->where('commande_id', $commande_id)->findAll();
    }


    public function getTotalAmount($statusFilter = ['Effectué', 'En attente'])
    {
        return $this->selectSum('montant')
            ->whereIn('statut', $statusFilter)
            ->get()
            ->getRow()
            ->montant;
    }


    public function getByMethode($methode)
    {
        return $this->where('methode', $methode)->findAll();
    }


    public function getByStatut($statut)
    {
        return $this->where('statut', $statut)->findAll();
    }


    public function getAllPaiementsOrdered($orderBy = 'created_at', $direction = 'DESC')
    {
        return $this->orderBy($orderBy, $direction)->findAll();
    }


    public function getLastQueryString()
    {
        return $this->db->getLastQuery()->getQuery();
    }
}
