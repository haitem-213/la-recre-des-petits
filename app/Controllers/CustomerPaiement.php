<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\PaiementModel ;
use App\Models\CommandeModel ;

class CustomerPaiement extends BaseController {
    protected $paiementModel;
    protected $session;

    public function __construct() {
        $this->paiementModel = new commandeModel();
    }
    
    public function create() {
        $session = session(); 
    
        $utilisateur_id = $session->get('id_utilisateur'); 
    
        if (empty($utilisateur_id)) {
            echo "❌ Echec!";
            return;
        }
    
        
        $totalc = $this->request->getPost('totalc', FILTER_SANITIZE_NUMBER_FLOAT) ?? 0;
        $statut = "En attente";
    
    
        var_dump($utilisateur_id, $totalc, $statut);
    
      
        if ($this->paiementModel->creerCommande($utilisateur_id, $totalc, $statut)) {
            return redirect()->to('/')->with('success', 'Paiement effectué avec succès !');
        } else {
            echo " EChec!";
        }
        
    }
    
    


}
