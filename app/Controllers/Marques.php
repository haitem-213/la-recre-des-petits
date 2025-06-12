<?php
namespace App\Controllers;


use App\Models\MarqueModel;
use App\Models\ProduitModel;

class Marques extends BaseController
{
    private $modele;

    public function __construct()
    {
        helper('form');
        $this->modele = model('MarqueModel');
    }

    
    public function index()
    {
        $model = new \App\Models\MarqueModel();
        $data['marques'] = $model->findAll();

        return view('Marques/marques', $data);
    }

    public function filtrerParMarques($id)
    {
        // Récupérer la marque par son id
        $marqueModel = new MarqueModel();
        $brandData = $marqueModel->find($id);

        // Si la marque existe
        if (!$brandData) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Récupérer les produits de cette marque
        $produitModel = new ProduitModel();
        $data['produits'] = $produitModel->where('marque_id', $id)->findAll();

        // Passer les données à la vue
        $data['brandName'] = $brandData['nomm']; // Le nom de la marque

        // Charger la vue
        return view('Produit/produits-par-marques', $data);
    }

    public function afficherToutesLesMarques(): string
    {
        $marques = $this->modele->listeToutesLesMarques();

        $donnees = [
            "titre" => "Liste de toutes les marques",
            "marques" => $marques
        ];

        return view('Marques/afficherToutesLesMarques', $donnees);
    }

    public function afficherUneMarque(int $id_marque): string
    {
        $marque = $this->modele->obtenirUneMarque($id_marque);

        if ($marque === null) {
            return view('echec', ['message' => 'Marque non trouvée']);
        }

        $donnees = [
            "titre" => "Ma marque",
            "marque" => $marque
        ];
        return view('Marques/afficherUneMarque', $donnees);
    }

    public function afficherFormulaireAjoutMarque(): string
    {
        if ($this->request->getMethod() === 'post' || $_SERVER['REQUEST_METHOD'] === 'POST') {
            $regles = [
                'nomm' => [
                    "label" => "Nom de la marque",
                    "rules" => "required|min_length[2]|max_length[100]",
                    "errors" => [
                        "required" => "Le nom de la marque est obligatoire",
                        "min_length" => "Le nom de la marque est trop court",
                        "max_length" => "Le nom de la marque est trop long"
                    ]
                ]
            ];

            if (!$this->validate($regles)) {
                $donnees['validation'] = $this->validator;
                return view('Marques/afficherFormulaireAjoutMarque', $donnees);
            } else {
                $nomm = $this->request->getPostGet('nomm');

                $donnees = [
                    'nomm' => $nomm
                ];

                log_message('debug', 'Données de la marque : ' . print_r($donnees, true));

                if ($this->modele->ajouterMarque($donnees)) {
                    return view('succes');
                } else {
                    log_message('debug', 'Données de la marque (échec) : ' . print_r($donnees, true));
                    return view('echec');
                }
            }
        } else {
            return view('Marques/afficherFormulaireAjoutMarque');
        }
    }

    public function supprimerMarque(int $id_marque)
    {
        if ($this->modele->supprimerMarque($id_marque)) {
            return view('succes');
        } else {
            return view('echec');
        }
    }

    public function mettreAJourMarque(int $id_marque): string
    {

        if ($this->request->getMethod() === 'post' || $_SERVER['REQUEST_METHOD'] === 'POST') {

            $regles = [
                'nomm' => [
                    "label" => "Nom de la marque",
                    "rules" => "required|min_length[2]|max_length[100]",
                    "errors" => [
                        "required" => "Le nom de la marque est obligatoire",
                        "min_length" => "Le nom de la marque est trop court",
                        "max_length" => "Le nom de la marque est trop long"
                    ]
                ]
            ];
            
            $nomm = $this->request->getPostGet('nomm');
            $data = [
                'nomm' => $nomm
            ];
            $this->modele->mettreAJourMarque($id_marque, $data);
            return view('succes');

        }


        return view('Marques/afficherFormulaireMiseAJourMarque', [
            "marque" => $this->modele->find($id_marque)
            
        ]);

        
     
    }
    
    

    public function afficherFormulaireMiseAJourMarque(int $id_marque): string
    {
        $marque = $this->modele->obtenirUneMarque($id_marque);
    
        if ($marque === null) {
            return view('echec', ['message' => 'Marque non trouvée']);
        }
    
        return view('Marques/afficherFormulaireMiseAJourMarque', ['marque' => $marque]);
    }
    

    public function afficherFormulaireSuppressionMarque(int $id_marque): string
    {
        $marque = $this->modele->obtenirUneMarque($id_marque);

        if ($marque === null) {
            return view('echec', ['message' => 'Marque non trouvée']);
        }

        return view('Marques/afficherFormulaireSuppressionMarque', ['marque' => $marque]);
    }
}
?>



