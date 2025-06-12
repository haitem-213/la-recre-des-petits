<?php

namespace App\Controllers;

use App\Models\CommandeModel;
use CodeIgniter\I18n\Time;

class Commande extends BaseController {
    protected $commandeModel;

    public function __construct() {
        $this->commandeModel = new CommandeModel();
    }

    public function index() {
        $data['title'] = 'Liste des Commandes';
        $data['commandes'] = $this->commandeModel->findAll();

        return view('Commande/index', $data);
    }

    public function create() {

        
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'utilisateur_id' => 'required|integer',
                'totalc' => 'required|decimal'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['title'] = 'Nouvelle Commande';
                return view('Commande/create', $data);
            }

            $data = [
                'utilisateur_id' => $this->request->getPost('utilisateur_id', FILTER_SANITIZE_NUMBER_INT),
                'date_de_commande' => Time::now('Europe/Paris', 'fr')->toDateTimeString(),
                'statut' => 'En attente',
                'totalc' => $this->request->getPost('totalc', FILTER_SANITIZE_NUMBER_FLOAT),
            ];

            if ($this->commandeModel->insert($data)) {
                return redirect()->to('/commande')->with('success', 'Commande créée avec succès!');
            } else {
                log_message('error', 'Erreur lors de la création de la commande: ' . json_encode($data));
                return redirect()->back()->with('error', 'Une erreur est survenue lors de la création.');
            }
        }

        $data['title'] = 'Nouvelle Commande';
        return view('Commande/create', $data);
    }

    public function update($id) {
        $commande = $this->commandeModel->find($id);
       

        if (!$commande) {
            return redirect()->to('/commande')->with('error', 'Commande introuvable.');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'statut' => 'required|in_list[En attente,En cours,Livré,Annulé]',
                'totalc' => 'required|decimal'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['commande'] = $commande;
                $data['title'] = 'Modifier Commande';
                return view('Commande/update', $data);
            }

            $data = [
                'statut' => $this->request->getPost('statut', FILTER_SANITIZE_STRING),
                'totalc' => $this->request->getPost('totalc', FILTER_SANITIZE_NUMBER_FLOAT),
            ];

            if ($this->commandeModel->update($id, $data)) {
                return redirect()->to('/commande')->with('success', 'Commande mise à jour avec succès!');
            } else {
                log_message('error', 'Erreur lors de la mise à jour de la commande ID: ' . $id);
                return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour.');
            }

        }

        $data['commande'] = $commande;
        $data['title'] = 'Modifier Commande';
        return view('Commande/update', $data);
    }

    public function delete($id) {
        if ($this->commandeModel->delete($id)) {
            return redirect()->to('/commande')->with('success', 'Commande supprimée avec succès!');
        } else {
            log_message('error', 'Erreur lors de la suppression de la commande ID: ' . $id);
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
