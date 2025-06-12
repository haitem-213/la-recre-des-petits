<?php

namespace App\Controllers;

use App\Models\AgeModel;

class Ages extends BaseController
{
    private $modele;

    public function __construct()
    {
        helper('form');
        $this->modele = model('AgeModel');
    }

    public function index()
    {
        return view('Ages/ages');
    }
   

    public function afficherListeAges(): string
    {
        $ages = $this->modele->listeTousLesAges();

        $donnees = [
            "titre" => "Liste de tous les âges",
            "ages"  => $ages
        ];

        return view('Ages/afficherListeAges', $donnees);
    }

    public function afficherUnAge(int $id_age): string
    {
        $age = $this->modele->obtenirUnAge($id_age);

        if ($age === null) {
            return view('echec', ['message' => 'Âge non trouvé']);
        }

        $donnees = [
            "titre" => "Mon âge",
            "age"   => $age
        ];
        return view('Ages/afficherUnAge', $donnees);
    }

    public function afficherFormulaireAjoutAge(): string
    {
        if ($this->request->getMethod() === 'post' || $_SERVER['REQUEST_METHOD'] === 'POST') {
            $regles = [
                'noma' => [
                    "label" => "Nom de l'âge",
                    "rules" => "required|min_length[2]|max_length[100]",
                    "errors" => [
                        "required"   => "Le nom de l'âge est obligatoire",
                        "min_length" => "Le nom de l'âge est trop court",
                        "max_length" => "Le nom de l'âge est trop long"
                    ]
                ]
            ];
            

            if (!$this->validate($regles)) {
                $donnees['validation'] = $this->validator;
                return view('Ages/afficherFormulaireAjoutAge', $donnees);
            } else {
                $nomAge = $this->request->getPostGet('noma');

                $donnees = [
                    'noma' => $nomAge
                ];

                log_message('debug', 'Données de l\'âge : ' . print_r($donnees, true));

                if ($this->modele->ajouterAge($donnees)) {
                    return view('succes');
                } else {
                    log_message('debug', 'Données de l\'âge (échec) : ' . print_r($donnees, true));
                    return view('echec');
                }
            }
        } else {
            return view('Ages/afficherFormulaireAjoutAge');
        }
    }

    public function supprimerAge(int $id_age)
    {
        if ($this->modele->supprimerAge($id_age)) {
            return view('succes');
        } else {
            return view('echec');
        }
    }

    public function mettreAJourAge(int $id_age)
    {
        return view('Ages/afficherFormulaireMiseAJourAge',[
            "age"=> $this->modele->find($id_age)]);
    }
    

    public function afficherFormulaireMiseAJourAge(int $id_age): string
    {
        log_message('debug', 'ID reçue pour mise à jour: ' . $id_age);
    
        $age = $this->modele->obtenirUnAge($id_age);
    
        if ($age === null) {
            return view('echec', ['message' => 'Âge non trouvé']);
        }
    
        return view('Ages/afficherFormulaireAjoutAge', ['age' => $age]);
    }
    
    public function afficherFormulaireSuppressionAge(int $id_age): string
    {
        $age = $this->modele->obtenirUnAge($id_age);

        if ($age === null) {
            return view('echec', ['message' => 'Âge non trouvé']);
        }

        return view('Ages/afficherFormulaireSuppressionAge', ['age' => $age]);
    }

    public function produitsParAge($age_id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM produits WHERE age_id = ?", [$age_id]);
        $data['produits'] = $query->getResult();

        return view('Ages/produits-par-age', $data);
    }

}


   

