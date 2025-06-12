<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = "utilisateurs"; // Nom de la table
    protected $primaryKey = "id_utilisateur"; // Nom du champ de la clé primaire

    protected $useAutoIncrement = true; // Utilisation de l'auto-incremente


    //['societe, nom, prenom,  email, role, adresse1, adresse2, code_postal, ville, telephone, mot_de_passe, cree_le'];
    protected $allowedFields =
    ['societe', 'nomu', 'prenomu', 'email', 'role', 'adresse1', 'adresse2', 'code_postal', 'ville', 'telephone', 'mot_de_passe', 'cree_le'];
    // Champs qu'on va utiliser

    /**
     * RULES DE VALIDATION POUR L'AJOUT D'UN UTILISATEUR
     */
    protected $validationRulesUpdate = [
        'societe' => 'permit_empty|max_length[100]',
        'adresse1' => 'permit_empty|max_length[100]',
        'adresse2' => 'permit_empty|max_length[100]',
        'code_postal' => 'permit_empty|max_length[10]',
        'ville' => 'permit_empty|max_length[100]',
        'telephone' => 'permit_empty|max_length[15]|numeric'
        
    ];

    protected $validationRules = [
        'societe' => 'permit_empty|max_length[100]',
        'nomu' => 'required|min_length[2]|max_length[100]',
        'prenomu' => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|max_length[100]|is_unique[utilisateurs.email]',
        'role' => 'in_list[superAdmin, admin, lecteur, client]',
        'adresse1' => 'permit_empty|max_length[100]',
        'adresse2' => 'permit_empty|max_length[100]',
        'code_postal' => 'permit_empty|max_length[5]',
        'ville' => 'permit_empty|max_length[100]',
        'telephone' => 'permit_empty|max_length[10]|numeric',
        'mot_de_passe' => 'required|min_length[8]|max_length[255]'

    ];

    protected $validationMessages = [
        'societe' => [
            'max_length' => 'Le nom de la societe ne doit pas dépasser 100 caractères.',
        ],

        'nomu' => [
            'required' => 'Le nom est obligatoire.',
            'min_length' => 'Le nom doit contenir au moins 2 caractères.',
            'max_length' => 'Le nom ne doit pas dépasser 100 caractères.',
        ],

        'prenomu' => [
            'required' => 'Le prénom est obligatoire.',
            'min_length' => 'Le prénom doit contenir au moins 2 caractères.',
            'max_length' => 'Le prénom ne doit pas dépasser 100 caractères.',
        ],

        'email' => [
            'required' => 'L\'email est obligatoire.',
            'valid_email' => 'Veuillez entrer une adresse email valide.',
            'max_length' => 'L\'email ne doit pas dépasser 100 caractères.',
            'is_unique' => 'Cet email est déjà utilisé.',
        ],

        'role' => [
            'required' => 'Le rôle est obligatoire.',
            'in_list' => 'Le rôle doit être l\'un des suivants : superAdmin, admin, modificateur, lecteur, client.',
        ],

        'adresse1' => [
            'max_length' => 'L\'adresse 1 ne doit pas dépasser 100 caractères.',
        ],

        'adresse2' => [
            'max_length' => 'L\'adresse 2 ne doit pas dépasser 100 caractères.',
        ],

        'code_postal' => [
            'max_length' => 'Le code postal ne doit pas dépasser 5 caractères.',
        ],

        'ville' => [
            'max_length' => 'La ville ne doit pas dépasser 100 caractères.',
        ],

        'telephone' => [
            'max_length' => 'Le numéro de téléphone ne doit pas dépasser 10 caractères.',
            'numeric' => 'Le numéro de téléphone ne doit contenir que des chiffres.',
        ],

        'mot_de_passe' => [
            'required' => 'Le mot de passe est obligatoire.',
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'max_length' => 'Le mot de passe ne doit pas dépasser 255 caractères.',
        ],


    ];


    public function index()
    {
        return view('Accueil/accueil');
    }

    /**
     * HASH LE MOT DE PASSE AVANT DE L'ENREGISTRER
    //  */
    // protected function hashMotDePasse(array $data)
    // {
    //     if (isset($data['mot_de_passe'])) {
    //         $data['mot_de_passe'] = password_hash($data['mot_de_passe'], PASSWORD_DEFAULT);
    //     } else {
    //         throw new \Exception("Erreur : mot_de_passe est manquant avant le hashage.");
    //     }
    //     return $data;
    // }

    /**
     * Récupère les utilisateurs en fonction du rôle de l'utilisateur connecté.
     *
     * @param string $role Le rôle de l'utilisateur connecté
     * @return array
     */
    public function listTousUtilisateurs(string $role): array
    {
        switch ($role) {
            case 'superAdmin':
                // Le superAdmin peut voir tous les utilisateurs
                return $this->select('id_utilisateur, nomu, prenomu, email, role')
                    ->get()
                    ->getResult();
                break; // S'assure que le code ne continue pas avec un autre case
            case 'admin':
                // L'admin peut voir les employés et les clients
                return $this->select('id_utilisateur, nomu, prenomu, email, role')
                    ->whereIn('role', ['admin', 'lecteur', 'client'])
                    ->get()
                    ->getResult();
                break; // S'assure que le code ne continue pas avec un autre case

            case 'lecteur':
                // Le lecteur peut voir une liste limitée d'utilisateurs
                return $this->select('id_utilisateur, nomu, prenomu, email, role')
                    ->where('role', 'client')
                    ->limit(15) // Limite à 15 utilisateurs
                    ->get()
                    ->getResult();
                break; // S'assure que le code ne continue pas avec un autre case
            default:
                // Par défaut, retourne un tableau vide
                return [];
        }
    }


    /**
     * RETOURNE TOUS LES UTILISATEURS
     * 
     * return array
     */

    public function listTousUtilisateursOld(): array
    {
        return $this->select('id_utilisateur, nomu, prenomu, email, role') // Pas besoin du mot de passe

            // Equivalent à SELECT * FROM article
            ->get()->getResult();
        //getResult : obtenir sous forme d'objet

    }

    // Etape 2 : Appel du controlleur : UtilisateurControll$this->session = services::session();er.php
    // Etape 3 : Appel de la vue, ICI : Utilisateur/cListTousUtilisateurs.php


    /**
     * AFFICHAGE DE TOUS LES CLIENTS
     * 
     * @return array
     */
    public function listTousClients(): array
    {
        return $this->select('id_utilisateur, nomu, prenomu, email, role')
            ->where('role', 'client') // Filtrer uniquement les clients
            ->get()
            ->getResult();
    }


    /**
     * AFFICHAGE DE TOUS LES EMPLOYES
     * 
     * @return array
     */
    public function listTousEmployes(): array
    {
        // Rôles des employés (à adapter selon votre application)
        $rolesEmployes = ['admin', 'modificateur', 'lecteur', 'superAdmin'];

        return $this->select('id_utilisateur, nomu, prenomu, email, role')
            ->whereIn('role', $rolesEmployes) // Filtrer les employés par leurs rôles
            ->get()
            ->getResult();
    }


    /**
     * AFFICHAGE D'UN UTILISATEUR VIA SON ID
     * 
     * @return object
     */

    public function listUnUtilisateur(int $id_utilisateur): ?object // soit objet, soit null
    {
        return $this->select('id_utilisateur, nomu, prenomu, email, role')
            ->where('id_utilisateur', $id_utilisateur)
            ->get()->getRow();
    }

    /**
     * AFFICHAGE D'UN UTILISATEUR VIA SON EMAIL
     * 
     * @param string $email L'email de l'utilisateur à rechercher
     * @return object|null L'utilisateur trouvé ou null si pas trouvé
     */
    public function listUnUtilisateurParEmail($email)
    {
        // Recherche de l'utilisateur par email et récupération sous forme de tableau associatif
        $user = $this->where('email', $email)->get()->getRowArray();
    
        if ($user) {
            log_message('debug', "Utilisateur trouvé : " . json_encode($user));
        } else {
            log_message('error', "Aucun utilisateur trouvé avec l'email : $email");
        }
    
        return $user;  // Retourne l'utilisateur ou null si non trouvé
    }



    
    

    /**
     * AJOUT D'UN UTILISATEUR
     */
    public function ajoutUtilisateur(array $data): bool
    {
        $session = \Config\Services::session(); // Initialisation de la session

        $data['mot_de_passe'] = password_hash($data['mot_de_passe'], PASSWORD_DEFAULT); // Hashage du mot de passe

        $filteredData = array_filter($data, function ($value) {
            return !is_null($value);
        });
        // On filtre les données pour ne pas insérer les valeurs null


        $id_utilisateur = $this->insert($filteredData); // On insère les données dans la table
        //var_dump($id_utilisateur);
        //die();

        // On récupère l'id de l'utilisateur inséré
        $utilisateur = $this->find($id_utilisateur); // On récupère un array au sujet de l'utilisateur
        //var_dump($utilisateur);
        //die();
        // On récupère un array au sujet de l'utilisateur


        //$session->set($utilisateur); // On stocke les données de l'utilisateur dans la session


        // On stocke les données de l'utilisateur dans la session

        $sessionData = [

// isset($utilisateur['societe']) : Cela vérifie si la clé 'societe' existe et est définie dans le tableau $utilisateur.
// ? $utilisateur['societe'] : Si la clé 'societe' existe, sa valeur est utilisée.
// : null : Si la clé 'societe' n'existe pas, la valeur null est assignée.//

            'id_utilisateur' => $id_utilisateur,
            'societe' => isset($utilisateur['societe']) ? $utilisateur['societe'] : null,
            'nomu' => isset($utilisateur['nomu']) ? $utilisateur['nomu'] : null,
            'prenomu' => isset($utilisateur['prenomu']) ? $utilisateur['prenomu'] : null,
            'email' => isset($utilisateur['email']) ? $utilisateur['email'] : null,
            'role' => isset($utilisateur['role']) ? $utilisateur['role'] : null,
            'adresse1' => isset($utilisateur['adresse1']) ? $utilisateur['adresse1'] : null,
            'adresse2' => isset($utilisateur['adresse2']) ? $utilisateur['adresse2'] : null,
            'code_postal' => isset($utilisateur['code_postal']) ? $utilisateur['code_postal'] : null,
            'ville' => isset($utilisateur['ville']) ? $utilisateur['ville'] : null,
            'telephone' => isset($utilisateur['telephone']) ? $utilisateur['telephone'] : null,
            'cree_le' => $cree_le = date('Y-m-d H:i:s')            
        ];

        //var_dump($data);
        //die();

        $session->set($sessionData); // On stocke les données de l'utilisateur dans la session

        return true; // Retourne true pour indiquer que tout s'est bien passé


    }


    /**
     * MODIFICATION  D'UN UTILISATEUR
     */
    public function modifUtilisateur(int $id_utilisateur, array $data): bool
    {
        $result = $this->db->table('utilisateurs')
                           ->where('id_utilisateur', $id_utilisateur)
                           ->update($data);
    
        if ($result) {
            log_message('debug', 'Profil mis à jour avec succès pour l\'ID utilisateur : ' . $id_utilisateur);
        } else {
            log_message('error', 'Échec de la mise à jour pour l\'ID utilisateur : ' . $id_utilisateur);
            log_message('error', 'Erreur de base de données : ' . print_r($this->db->error(), true));
        }
    
        return $result;
    }

    /**
     * SUPPRESSION D'UN UTILISATEUR
     */
    public function supprUtilisateur(int $id_utilisateur): bool
    {
        return $this->delete($id_utilisateur);
    }
}