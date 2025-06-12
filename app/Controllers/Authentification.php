<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use CodeIgniter\Exceptions\PageNotFoundException;
//use CodeIgniter\I18n\Time;
use Config\Services;

use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class Authentification extends BaseController
{
    private $model; // 
    protected Session $session; 

    public function __construct()
    // Construction d'un nouvel utilisateur - employé de la société
    {
        helper('form');
        helper('session');

        $this->model = new UtilisateurModel(); //Instantiation du model

        $this->session = session(); //  Assignation de la session
    }


    public function testVerifierMotDePasse()
    {
        // Exemple de valeurs à tester
        $motDePasseClair = 'azertyuiop';
        $hash = '$2y$10$LVbEcmn2FQxl0S0om2aeMuFEV7RBBj98LEvsCMGJQL2VF0cavENFu'; // Exemple de hash
        $email = 'mama@gmail.com';

        // Appel de la méthode privée (comme elle est dans le même contrôleur, on peut y accéder directement)
        $resultat = $this->verifierMotDePasse($motDePasseClair, $hash, $email);

        // Affiche le résultat pour tester
        echo '<pre>';
        echo 'Résultat de verifierMotDePasse : ' . ($resultat ? 'Succès' : 'Échec');
        echo '</pre>';
    }



    public function indexInscription()
    {
        return view('Inscription/cValidationInscriptionClient');
    }



    public function indexConnexion()
    {

        return view('Compte/compte');
    }


    /**
     * L'INSCRIPTION DES CLIENTS 
     * 
     * Les employés sont insérés dans la bdd par le superAdmin
     */


    /**
     * Affiche le formulaire pour que le client puisse compléter les informations personnelles
     *
     * Pour compléter le profil :
     * Dans un 1er temps, on affiche le formulaire avec les champs vides qui sont vides dans la bdd
     * Dans un 2ème temps, on récupère les données du formulaire et on les insère dans la bdd
     * Ensuite, on redirige l'utilisateur vers la page d'accueil pour qu'il puisse se connecter
     * Mais si le formulaire n'est pas soumis, on vérifie si l'utilisateur n'existe pas et on ré-afficher le formulaire
     * 
     */
    public function testSession()
    {
        session()->set('test_key', 'Valeur de test');
        echo 'Session test_key: ' . session()->get('test_key');
    }

    public function testPassword()
    {
        $hash = '$2y$10$sSU8bdUSdtDcNK7ttHoMBuzX6TEfPyVre4nNcKtf6G56/HGYa4sU6';
        $motDePasse = 'azertyuiop';

        if (password_verify($motDePasse, $hash)) {
            echo "✅ Le mot de passe correspond au hash.";
        } else {
            echo "❌ Le mot de passe ne correspond pas au hash.";
        }
    }


    public function completerProfil()
    {
        // Récupérer l'ID de l'utilisateur connecté
        $id_utilisateur = session('id_utilisateur');
        log_message('debug', 'ID utilisateur récupéré depuis la session : ' . $id_utilisateur);


        // Récupérer les données de l'utilisateur
        $utilisateur = $this->model->find($id_utilisateur);
        if (!$utilisateur) {
            log_message('error', 'Utilisateur non trouvé avec l\'ID : ' . $id_utilisateur);
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non trouvé.');
        }

        // Si le formulaire est soumis en méthode POST
        if ($this->request->is('post')) {
            // Récupérer les données du formulaire
            $data = [
                'societe' => $this->request->getPost('societe'),
                'adresse1' => $this->request->getPost('adresse1'),
                'adresse2' => $this->request->getPost('adresse2'),
                'code_postal' => $this->request->getPost('code_postal'),
                'ville' => $this->request->getPost('ville'),
                'telephone' => $this->request->getPost('telephone')
            ];

            log_message('debug', 'Données reçues du formulaire : ' . print_r($data, true));

            // Utiliser les règles de validation spécifiques à la mise à jour
            if (!$this->validate($this->model->validationRulesUpdate)) {
                log_message('error', 'Validation échouée pour les données : ' . print_r($data, true));
                log_message('error', 'Erreurs de validation : ' . print_r($this->validator->getErrors(), true));
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            // Mise à jour des informations dans la base de données
            if ($this->model->modifUtilisateur($id_utilisateur, $data)) {
                log_message('debug', 'Profil mis à jour avec succès pour l\'ID utilisateur : ' . $id_utilisateur);
                return redirect()->to(base_url('/'))->with('success', 'Informations mises à jour avec succès !');
            } else {
                log_message('error', 'Échec de la mise à jour pour l\'ID utilisateur : ' . $id_utilisateur);
                return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour des informations.');
            }
        }

        // Si la méthode est GET, afficher le formulaire avec les informations actuelles de l'utilisateur
        return view('EspaceClient/cProfil', [
            'utilisateur' => $utilisateur,
            'id_utilisateur' => $id_utilisateur
        ]);
    }


    public function cValidationInscriptionClient()
    {
        // Si le formulaire est soumis (méthode POST)
        if (($this->request->is('post') == true)) {

            // Récupération des données du formulaire
            $data = [
                'nomu' => $this->request->getPost('nomu'),
                'prenomu' => $this->request->getPost('prenomu'),
                'email' => $this->request->getPost('email'),
                'role' => 'client', // pour forcer le rôle client
                'mot_de_passe' => $this->request->getPost('mot_de_passe')
            ];


            // Validation des données qui vont s'insérer dans la bdd
            if ($this->model->ajoutUtilisateur($data)) {

                // Redirection avec un message de succès
                return redirect()->to(base_url('/completer-profil'))->with('success', 'Inscription réussie !');
                //return view('EspaceClient/cProfil');

            } else {

                // Redirection avec un message d'erreur
                return redirect()->back()->withInput()->with(
                    'error',
                    'Erreur lors de l’inscription.'
                );
            }
        }

        // Si la méthode est GET, afficher le formulaire
        return view('Inscription/cValidationInscriptionClient');
    }




    /**
     * FONCTION LOGIN POUR TOUS LES UTILISATEURS
     * 
     * Si c'est un client qui se logue, alors il accédera à la page accueil avec un message 
     * si c'est un employé il accédera au dashboard cListTousUtilisateurs.php
     * 
     * @var array{mot_de_passe: string, ...} $utilisateur
     */

    public function cLoginUtilisateurForm()
    {
        if (!$this->request->is('post')) {
            session()->setFlashdata('error', 'Email ou mot de passe incorrect.');
            session()->setFlashdata('showLoginModal', true);
            return redirect()->to('/');

            //return view('Utilisateur/layout-compte');
        }

        // Affiche ce qui est envoyé via POST et arrête l'exécution pour voir si les données sont bien envoyées 
        //var_dump($_POST);
        //exit;  ==> OK



        log_message('debug', 'Tentative de connexion initiée'); //OK

        $email = $this->request->getPost('email');
        $motDePasse = $this->request->getPost('mot_de_passe');
        $motDePasse = preg_replace('/\s+/', '', $motDePasse);


        // Logs pour vérifier le mot de passe reçu
        //log_message('debug', 'Mot de passe haché récupéré de la DB : [' . 'INDEFINI A CE POINT' . ']');
        //log_message('debug', 'Mot de passe brut reçu : [' . $motDePasse . ']');
        //log_message('debug', 'Mot de passe après trim : [' . trim($motDePasse) . ']');



        if (!$this->validerChamps($email, $motDePasse)) {
            return redirect()->back()->with('error', 'Email ou mot de passe non fourni.');
        }

        $utilisateur = $this->trouverUtilisateurParEmail($email);
        if (!$utilisateur) {
            return redirect()->back()->with('error', 'Identifiants incorrects.');
        }

        // Assigne le hash AVANT de l'utiliser :
        $motDePasseHash = $utilisateur['mot_de_passe'] ?? '';
        log_message('debug', 'Mot de passe haché récupéré de la DB : [' . $motDePasseHash . '] (longueur : ' . strlen($motDePasseHash) . ')');

        $test = password_verify($motDePasse, $motDePasseHash);
        log_message('debug', 'Test direct password_verify : ' . ($test ? 'Succès' : 'Échec'));

        if (!$this->verifierMotDePasse($motDePasse, $utilisateur['mot_de_passe'], $email)) {
           return redirect()->back()->with('error', 'Identifiants incorrects.');
        }

        $this->initialiserSession($utilisateur);

        return $this->redirigerSelonRole($utilisateur);
    }





    private function validerChamps(?string $email, ?string $motDePasse): bool
    {
        if (empty($email) || empty($motDePasse)) {
            log_message('debug', 'Champs email ou mot de passe vides');
            return false;
        }
        return true;
    }

    private function trouverUtilisateurParEmail(string $email): ?array
    {
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->listUnUtilisateurParEmail($email);

        if ($utilisateur) {
            log_message('debug', 'Utilisateur trouvé : ' . json_encode($utilisateur));
        } else {
            log_message('debug', 'Aucun utilisateur trouvé pour email: ' . $email);
        }

        return $utilisateur ?: null;
    }

    private function verifierMotDePasse(string $motDePasse, string $hash, string $email): bool
    {
        try {
            log_message('debug', 'Début vérification mot de passe');
            if (password_verify($motDePasse, $hash)) {
                log_message('debug', 'Mot de passe vérifié avec succès pour: ' . $email);
                return true;
            }
            log_message('warning', 'Mot de passe incorrect pour: ' . $email);
        } catch (\Throwable $e) {
            log_message('error', 'Erreur technique lors de la vérification du mot de passe: ' . $e->getMessage());
        }

        return false;
    }

    private function initialiserSession(array $utilisateur): void
    {
        session()->regenerate();
        session()->set([
            'id_utilisateur' => $utilisateur['id_utilisateur'],
            'email' => $utilisateur['email'],
            'role' => $utilisateur['role'],
            'nomu' => $utilisateur['nomu'],
            'prenomu' => $utilisateur['prenomu'],
            'logged_in' => true
        ]);

        log_message('debug', 'Session utilisateur initialisée : ' . json_encode(session()->get()));
    }

    private function redirigerSelonRole(array $utilisateur)
    {
        $message = "Bienvenue " . $utilisateur['prenomu'] . " " . $utilisateur['nomu'] . " !";

        if ($utilisateur['role'] === 'client') {
            return redirect()->to('/')->with('success', $message);
        }

        return redirect()->to('/utilisateurs')->with('success', $message);
    }







    /**
     * FONCTION DE LOGOUT
     */

     public function logout()
     {
         
         session()->destroy();
     
         
         return redirect()->to('/login')->with('success', 'Vous êtes déconnecté avec succès.');
     }
     
}