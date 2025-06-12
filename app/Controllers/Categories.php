<?php

namespace App\Controllers;

use App\Models\CategorieModel;
use App\Models\ProduitModel;

class Categories extends BaseController
{
    // Afficher la liste de toutes les catégories
    public function index()
    {
        $categorieModel = new CategorieModel();
        $data['categories'] = $categorieModel->findAll();

        return view('Categories/categories', $data);
    }

    // Afficher les produits liés à une catégorie spécifique
    public function filtrerParCategories($id)
    {
        // Récupérer la catégorie par son ID pour afficher son nom
        $categorieModel = new CategorieModel();
        $categorie = $categorieModel->find($id);

        if (!$categorie) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Récupérer les produits dont la colonne categorie_id correspond à l'ID donné
        $produitModel = new ProduitModel();
        $data['produits'] = $produitModel->where('categorie_id', $id)->findAll();

        // Passer le nom de la catégorie à la vue (pour l'affichage du titre par exemple)
        $data['categorieName'] = $categorie['nomc'];


        // Charger la vue
        return view('Produit/produits-par-categories', $data);
    }
}