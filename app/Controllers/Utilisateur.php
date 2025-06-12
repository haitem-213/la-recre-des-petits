<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time; // = Bibliothèque pour gérer les dates
use Config\Services;

class Utilisateur extends BaseController
{
    private $model; // 

    public function __construct()
    // Construction d'un nouvel utilisateure - employé de la société
    {
        helper('form');
        // $this->model = new UtilisateurModel(); PB BDD CHANGE PAR :
        $this->model = new UtilisateurModel();
    }// Fin function construct

    // Pour tester la connexion si un message d'erreur apparait 

    public function testConnexion()
    {
        $db = \Config\Database::connect();
        if ($db->connect()) {
            echo "Connexion à la base de données réussie !";
        } else {
            echo "Échec de la connexion à la base de données.";
        }
    }


    public function testPassword()
    {
        $hash = '$2y$10$LVbEcmn2FQxl0S0om2aeMuFEV7RBBj98LEvsCMGJQL2VF0cavENFu';
        $motDePasse = 'azertyuiop';

        if (password_verify($motDePasse, $hash)) {
            echo "✅ Le mot de passe correspond au hash.";
        } else {
            echo "❌ Le mot de passe ne correspond pas au hash.";
        }
    }

    


    /**
     * POUR AFFICHER TOUS LES UTILISATEURS 
     * 
     * charge les données depuis le modèle et les envoie à la vue
     */

    //Affiche la liste des utilisateurs en fonction du rôle de l'utilisateur connecté.

    public function cListTousUtilisateurs()
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        // Récupérer le rôle de l'utilisateur connecté
        $role = session()->get('role');

        // Empêcher les clients d'accéder à cette page
        if ($role === 'client') {
            return redirect()->to('/')->with('error', 'Accès non autorisé.');
        }

        // Récupérer les utilisateurs pour les employés
        $utilisateurModel = new UtilisateurModel();
        $utilisateurs = $utilisateurModel->listTousUtilisateurs($role);

        $data = [
            "title" => "Liste de tous les utilisateurs",
            "utilisateurs" => $utilisateurs
        ];

        return view('Utilisateur/cListTousUtilisateurs', $data);
    }



    //      public function clistTousUtilisateursOld()
//     {
//         // Appel de la fonction  
//         //$utilisateurs = $this->model->listTousUtilisateurs();
//         $data = [
//             "title" => "Liste de tous les utilisateurs",
//             "utilisateurs" => $utilisateurs
//         ];
//         return view('Utilisateur/cListTousUtilisateurs', $data);
//     } // fin tous les utilisateurs

    //     public function clistTousClients()
// {
//     // Récupérer tous les clients depuis le modèle
//     $clients = $this->model->listTousClients();

    //     // Préparer les données pour la vue
//     $data = [
//         "title" => "Liste de tous les clients",
//         "clients" => $clients
//     ];

    //     // Charger la vue et passer les données
//     return view('Utilisateur/cListTousClients', $data);
// }

    public function clistTousEmployes()
    {
        // Récupérer tous les employés depuis le modèle
        $employes = $this->model->listTousEmployes();

        // Préparer les données pour la vue
        $data = [
            "title" => "Liste de tous les employés",
            "employes" => $employes
        ];

        // Charger la vue et passer les données
        return view('Utilisateur/cListTousEmployes', $data);
    }

    /**
     * POUR AFFICHER UN SEUL UTILISATEUR VIA SON ID
     *
     */
    public function cListUnUtilisateur(int $id_utilisateur): string
    {
        // Récupérer l'utilisateur depuis le modèle
        $utilisateur = $this->model->listUnUtilisateur($id_utilisateur);

        // Initialiser un message d'erreur à null
        $message = null;

        // Si aucun utilisateur n'est trouvé, création d'un objet vide  avec null
        if ($utilisateur === null) {
            $utilisateur = (object) [
                'id_utilisateur' => null,
                'nomu' => null,
                'prenomu' => null,
                'email' => null,
                'role' => null,
            ];
            // Définir le message d'erreur
            $message = "L'utilisateur n'existe pas.";
        }

        // Préparer les données pour la vue
        $data = [
            'title' => "Un utilisateur",
            'utilisateur' => $utilisateur,
            'message' => $message // Ajouter le message à la vue
        ];

        // Retourner la vue avec les données
        return view('Utilisateur/cListUnUtilisateur', $data);
    } // Fin function afficher un utilisateur

    /** 
     * POUR MODIFIER UN UTILISATEUR 
     */
    public function cModifUtilisateur(int $id_utilisateur): string
    {

        $utilisateur = $this->model->listUnUtilisateur($id_utilisateur);

        // Initialiser un message d'erreur à null
        $message = null;
        log_message('debug', 'Fonction cModifUtilisateur appelée pour ID : ' . $id_utilisateur);

        // Si aucun utilisateur n'est trouvé, créer un objet vide avec les propriétés attendues
        if ($utilisateur === null) {
            $utilisateur = (object) [
                'id_utilisateur' => null,
                'nomu' => null,
                'prenomu' => null,
                'email' => null,
                'role' => null,
            ];

            // Définir le message d'erreur
            $message = "L'utilisateur n'existe pas.";
        }

        $data =
            [
                'title' => "Modifier un utilisateur",
                'utilisateur' => $utilisateur,
                'message' => $message // Ajouter le message à la vue
            ];
        return view('Utilisateur/cModifUtilisateur', $data);
    } // fin function cModifUtilisateur





    /**
     * POUR SUPPRIMER UN UTILISATEUR
     */
    public function cSupprUtilisateur(int $id_utilisateur)
    {
        $this->model->supprUtilisateur($id_utilisateur);
        return redirect()->to('/Utilisateur/cListTousUtilisateurs');
    }

    /**
     * AJOUT D'UN UTILISATEUR VIA UN FORMULAIRE
     */
    public function cAjoutUtilisateurForm()
    // j'ai enlevé :string à la fonction de façon à ce que la redirection puisse fonctionner.
    {
        // Titre par défaut
        $data['title'] = "AJOUT D'UN UTILISATEUR";

        // Si le formulaire n'a pas été soumis
        if ($this->request->is('post') == false) {
            return view('Utilisateur/cAjoutUtilisateurForm', $data);

            die("La requête POST est bien reçue");
            // pour voir si la requête arrive bien au POST

        } else {
            // Le formulaire a été soumis, on procède à la validation
            // validate est une fonction de codeigniter et non de model
            if (!$this->validate($this->model->validationRules)) {

                // Si la validation échoue, ajouter les erreurs aux données
                $data['errors'] = $this->validator->getErrors();
                return view('Utilisateur/cAjoutUtilisateurForm', $data);

            } else {
                // Si la validation réussit, préparer les données pour l'insertion
                $data['societe'] = $this->request->getPost('societe');
                $data['nomu'] = $this->request->getPost('nomu');
                $data['prenomu'] = $this->request->getPost('prenomu');
                $data['email'] = $this->request->getPost('email');
                $data['role'] = $this->request->getPost('role');
                $data['adresse1'] = $this->request->getPost('adresse1');
                $data['adresse2'] = $this->request->getPost('adresse2');
                $data['code_postal'] = $this->request->getPost('code_postal');
                $data['ville'] = $this->request->getPost('ville');
                $data['telephone'] = $this->request->getPost('telephone');
                $data['mot_de_passe'] = password_hash($this->request->getPost('mot_de_passe'), PASSWORD_DEFAULT);


                // Tenter d'ajouter l'utilisateur
                if ($this->model->ajoutUtilisateur($data)) {
                    // Rediriger vers la liste des utilisateurs avec un message de succès
                    return redirect()->to('/utilisateurs')->with('success', 'Utilisateur ajouté avec succès.');

                } else {
                    // Retourner au formulaire avec un message d'erreur
                    $data['errors'] = ['Erreur lors de l\'ajout de l\'utilisateur.'];
                    return view('Utilisateur/cAjoutUtilisateurForm', $data);
                } // dernier else

            } // 2ème else
        } // 1er else
        die("La requête est bien reçue");
    } // FIN FUNCTION AJOUT UTILISATEUR VIA FORMULAIRE







}

