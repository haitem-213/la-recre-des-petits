<?php 
namespace App\Controllers;

class Produit extends BaseController
{
    private $modele;

    public function __construct()
    {
        helper('form');
        $this->modele = model('ProduitModel');
    }

    public function afficherTousLesProduits(): string
    {
        $produits = $this->modele->listeTousLesProduits();

        $donnees = [
            "titre" => "Liste de tous les produits",
            "produits" => $produits
        ];

        return view('Produit/afficherTousLesProduits', $donnees);
    }

    public function afficherUnProduit(int $idproduit): string
    {
        $produit = $this->modele->obtenirUnProduit($idproduit);
    
      
    
        $donnees = [
            "titre" => "Mon produit",
            "produit" => $produit
        ];
        return view('Produit/afficherUnProduit', $donnees);
    }
    

    public function afficherFormulaireAjoutProduit()
    {
        if ($this->request->getMethod() === 'POST') {
            $regles = [
                'nomp' => [
                    "label" => 'Nom du produit',
                    "rules" => 'required|min_length[2]|max_length[100]',
                    "errors" => [
                        'required' => "Le nom est obligatoire",
                        'min_length' => "Le nom est trop court",
                        'max_length' => "Le nom est trop long"
                    ]
                ],
                'description' => [
                    "label" => 'Description',
                    "rules" => 'required',
                    "errors" => [
                        'required' => "La description est obligatoire"
                    ]
                ],
                'prix' => [
                    "label" => 'Prix',
                    "rules" => 'required|numeric',
                    "errors" => [
                        'required' => "Le prix est obligatoire",
                        'numeric' => "Le prix doit être un nombre"
                    ]
                ],
                'stock' => [
                    "label" => 'Stock',
                    "rules" => 'required|integer',
                    "errors" => [
                        'required' => "Le stock est obligatoire",
                        'integer' => "Le stock doit être un nombre entier"
                    ]
                ],
                'image' => [
                    "label" => 'Image',
                    "rules" => 'required',
                    "errors" => [
                        'required' => "L'image est obligatoire"
                    ]
                ],
                'categorie_id' => [
                    "label" => 'Catégorie',
                    "rules" => 'required|integer',
                    "errors" => [
                        'required' => "La catégorie est obligatoire",
                        'integer' => "La catégorie doit être un nombre entier"
                    ]
                ],
                'age_id' => [
                    "label" => 'Âge',
                    "rules" => 'required|integer',
                    "errors" => [
                        'required' => "L'âge est obligatoire",
                        'integer' => "L'âge doit être un nombre entier"
                    ]
                ],
                'marque_id' => [
                    "label" => 'Marque',
                    "rules" => 'required|integer',
                    "errors" => [
                        'required' => "La marque est obligatoire",
                        'integer' => "La marque doit être un nombre entier"
                    ]
                ]
            ];
    
            if (!$this->validate($regles)) {
                return view('Produit/afficherFormulaireAjoutProduit');
            }
    
            $donnees = [
                'nomp' => $this->request->getPost('nomp'),
                'description' => $this->request->getPost('description'),
                'prix' => $this->request->getPost('prix'),
                'stock' => $this->request->getPost('stock'),
                'image' => $this->request->getPost('image'),
                'categorie_id' => $this->request->getPost('categorie_id'),
                'age_id' => $this->request->getPost('age_id'),
                'marque_id' => $this->request->getPost('marque_id'),
                'date_de_creation' => date('Y-m-d H:i:s')
            ];
    
            if ($this->modele->ajouterProduit($donnees)) {
                return view('succes');
            } else {
                return view('echec');
            }
        } else {
            return view('Produit/afficherFormulaireAjoutProduit');
        }
    }

    public function supprimerProduit(int $idproduit)
    {
        log_message('debug', 'Supprimer produit ID: ' . $idproduit);
    
        if ($this->modele->supprimer($idproduit)) {
            log_message('debug', 'Produit supprimé avec succès.');
            return view('succes');
        } else {
            log_message('error', 'Échec lors de la suppression du produit.');
            return view('echec');
        }
    }
    public function mettreAJourProFormulaire(int $idproduit)
    {
        
         return view('Produit/mettreAJourProduit',[
            "produit"=> $this->modele->find($idproduit)]);
    }

    public function mettreAJourProduit(int $idproduit): string
    {
        $donnees = [
            'nomp' => $this->request->getPost('nomp'),
            'description' => $this->request->getPost('description'),
            'prix' => $this->request->getPost('prix'),
            'stock' => $this->request->getPost('stock'),
            'image' => $this->request->getPost('image'),
            'categorie_id' => $this->request->getPost('categorie_id'),
            'age_id' => $this->request->getPost('age_id'),
            'marque_id' => $this->request->getPost('marque_id')
        ];
    
        log_message('debug', 'Données reçues: ' . json_encode($donnees));
    
        if ($this->modele->mettreAJourProduit($idproduit, $donnees)) {
            log_message('debug', 'Produit mis à jour avec succès.');
            return view('succes');
        } else {
            log_message('error', 'Échec lors de la mise à jour du produit.');
            return view('echec');
        }
    }
    


    
}
?>