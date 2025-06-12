<?php

namespace App\Controllers;

use App\Models\ProduitModel;

class Panier extends BaseController
{
    public function index()
    {
        $session = session();
        $data['panier']= $session->get('panier') ?? [];
        return view('Panier/panier', $data);
    }

    public function ajouter($id_produit)
{
    $produitModel = new ProduitModel();
    $produit = $produitModel->find($id_produit);

    if ($produit) {
        $session = session();
        $panier = $session->get('panier') ?? [];

        if (isset($panier[$id_produit])) {
            $panier[$id_produit]['quantite'] += 1;
        } else {
            $panier[$id_produit] = [
                'id'       => $id_produit,
                'nomp'     => $produit->nomp,   // Assurez-vous que c'est bien la bonne syntaxe (objet vs tableau)
                'prix'     => $produit->prix,
                'image'    => $produit->image,
                'quantite' => 1
            ];
        }

        // Mettre à jour la session avec le nouveau panier
        $session->set('panier', $panier);

        return redirect()->to(base_url('panier'))->with('success', 'Produit ajouté au panier');
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}


public function supprimer($id)
{
    $panier = session()->get('panier');
    if(isset($panier[$id])) {
        unset($panier[$id]);
        session()->set('panier', $panier);
    }
    return redirect()->to('/panier');
}
public function modifier($id)
{
    $quantite = $this->request->getPost('quantite');
    $panier = session()->get('panier');

    
    if (isset($panier[$id]) && $quantite > 0) {
        $panier[$id]['quantite'] = $quantite; 
        session()->set('panier', $panier);   
    }

    return redirect()->to('/panier');
}


}


