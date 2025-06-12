<?php

namespace App\Controllers;

use App\Models\PaiementModel;

class Paiement extends BaseController {
    protected $paiementModel;

    public function __construct() {
        $this->paiementModel = new PaiementModel();
    }

    public function index() {
        $data['title'] = 'Liste des Paiements';
        $data['paiements'] = $this->paiementModel->findAll();

        return view('Paiement/index', $data);
    }

    public function create() {
        if ($this->request->getMethod() === 'post') {
           
            $commande_id = $this->request->getPost('commande_id');
    
           
            if (empty($commande_id)) {
                return redirect()->back()->with('error', 'Commande ID manquant!'); 
            }
    
            $rules = [
                'commande_id' => 'required|integer',
                'montant' => 'required|decimal',
                'methode' => 'required|string',
                'statut' => 'required|in_list[En attente,Effectué,Annulé]'
            ];
    
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['title'] = 'Nouveau Paiement';
                return view('Paiement/create', $data);
            }
    
            $data = [
                'commande_id' => $commande_id,
                'montant' => $this->request->getPost('montant'),
                'methode' => $this->request->getPost('methode'),
                'statut' => $this->request->getPost('statut'),
            ];
    
            if ($this->paiementModel->insert($data)) {
                return redirect()->to('/paiement')->with('success', 'Paiement créé avec succès!');
            } else {
                return redirect()->back()->with('error', 'Une erreur est survenue lors de la création.');
            }
        }
    
        $data['title'] = 'Nouveau Paiement';
        return view('Paiement/create', $data);
    }
    

    
}
