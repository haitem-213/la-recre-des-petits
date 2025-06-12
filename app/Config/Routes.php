<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultController('Accueil');


$routes->get('/', 'Accueil::index');


$routes->get('/categories', 'Categories::index');
$routes->get('/ages', 'Ages::index');
$routes->get('/marques', 'Marques::index');
$routes->get('/qui-sommes-nous', 'QuiSommesNous::index');
$routes->get('/panier', 'Panier::index');

$routes->get('/compte', 'Compte::index');
// $routes->get('inscription', 'Inscription::index');








$routes->add('ajouter-produit-form', 'Produit::afficherFormulaireAjoutProduit');
$routes->post('afficherFormulaireAjoutProduit', 'Produit::afficherFormulaireAjoutProduit'); 

$routes->get('tous-les-produits', 'Produit::afficherTousLesProduits');
$routes->get('produit/(:num)', 'Produit::afficherUnProduit/$1'); 

$routes->get('/modifier-produit/(:num)', 'Produit::mettreAJourProFormulaire/$1'); 
$routes->post('/modifier-produit/(:num)', 'Produit::mettreAJourProduit/$1'); 

$routes->get('/supprimer-produit/(:num)', 'Produit::supprimerProduit/$1'); 
$routes->post('/supprimer-produit/(:num)', 'Produit::supprimerProduit/$1'); 






$routes->get('/tous-les-ages', 'Ages::afficherListeAges');

$routes->get('/age/(:num)', 'Ages::afficherUnAge/$1');

$routes->get('/ajouter-age', 'Ages::afficherFormulaireAjoutAge');
$routes->post('/ajouter-age', 'Ages::afficherFormulaireAjoutAge');

$routes->get('/maj-age/(:num)', 'Ages::afficherFormulaireMiseAJourAge/$1'); 
$routes->post('/maj-age/(:num)', 'Ages::mettreAJourAge/$1');


$routes->get('/supprimer-age/(:num)', 'Ages::afficherFormulaireSuppressionAge/$1');
$routes->post('/supprimer-age/(:num)', 'Ages::supprimerAge/$1');


$routes->get('ages/(:num)', 'Ages::produitsParAge/$1');



$routes->get('toutes-les-marques', 'Marques::afficherToutesLesMarques');
$routes->get('marque/(:num)', 'Marques::afficherUneMarque/$1');

$routes->get('ajouter-marque-formulaire', 'Marques::afficherFormulaireAjoutMarque');
$routes->post('ajouter-marque-formulaire', 'Marques::afficherFormulaireAjoutMarque');

$routes->get('/modifier-marque/(:num)', 'Marques::afficherFormulaireMiseAJourMarque/$1');
$routes->post('/modifier-marque/(:num)', 'Marques::mettreAJourMarque/$1');

$routes->get('/supprimer-marque/(:num)', 'Marques::supprimerMarque/$1');

$routes->post('supprimer-marque/(:num)', 'Marques::supprimerMarque/$1');


$routes->get('marques/(:num)', 'Marques::filtrerParMarques/$1');



$routes->get('/dashboard','Utilisateur::clistTousUtilisateurs');




$routes->get('/commande', 'Commande::index');
$routes->get('/commande-create', 'Commande::create'); 
$routes->post('/commande/create', 'Commande::create'); 
$routes->get('/commande-update/(:num)', 'Commande::update/$1'); 
$routes->post('/commande-update/(:num)', 'Commande::update/$1'); 
$routes->get('/commande-delete/(:num)', 'Commande::delete/$1'); 



/**
 * ROUTES POUR LES PAEIMENT
 */


$routes->get('paiement', 'Paiement::index');

$routes->post('paiement', 'Paiement::index');

$routes->get('/paiement-succes', 'CustomerPaiement::succes');
$routes->get('/paiement-echec', 'CustomerPaiement::echec');
$routes->post('/paiement-create', 'CustomerPaiement::create');
$routes->get('/paiement-create', 'CustomerPaiement::create');


 $routes->get('/paiement/create', 'Paiement::create');
 $routes->post('/paiement/create', 'Paiement::create');

 $routes->get('paiement/checkRoutes', 'Paiement::checkRoutes');
 $routes->post('paiement/checkRoutes', 'Paiement::checkRoutes');


$routes->add('/inscription', 'Authentification::cValidationInscriptionClient');

// A partir de cValidationInscriptionClient, on peut rediriger vers completerProfil
$routes->add('/completer-profil', 'Authentification::completerProfil');

$routes->post('/completer-profil/(:num)', 'Authentification::completerProfil/$1'); // Pour compléter le profil



/**
 * ROUTES POUR LES UTILISATEURS
 */
 // pour permettre aux utilisateurs de se loguer (employes ou clients)
$routes->add('/log-utilisateur', 'Authentification::cLoginUtilisateurForm');


 // Liste de tous les utilisateurs
 $routes->get('/utilisateurs', 'Utilisateur::clistTousUtilisateurs');

 // Liste de tous les clients
 $routes->get('/clients', 'Utilisateur::clistTousClients');
 
 // Liste de tous les employés
 $routes->get('/employes', 'Utilisateur::clistTousEmployes');
 
 // Affichage d'un utilisateur via son id
 $routes->get('/utilisateur/(:num)', 'Utilisateur::cListUnUtilisateur/$1');
 
 // Modification d'un utilisateur
 $routes->get('/utilisateur/modifier/(:num)', 'Utilisateur::cModifUtilisateur/$1');
 
 // Supprimer un utilisateur
 $routes->get('/utilisateur/supprimer/(:num)', 'Utilisateur::cSupprUtilisateur/$1');
 
 // pour ajouter un utilisateur via le formulaire
 $routes->get('utilisateur/ajouter-un-utilisateur', 'Utilisateur::cAjoutUtilisateurForm');
 $routes->post('utilisateur/ajouter-un-utilisateur', 'Utilisateur::cAjoutUtilisateurForm');
 


 


//  /**
//  * ROUTES POUR PANIER
//  */

$routes->get('/panier', 'Panier::index');
$routes->get('panier/ajouter/(:num)', 'Panier::ajouter/$1');
$routes->get('/voir', 'Panier::voir');
$routes->post('panier/supprimer/(:num)', 'Panier::supprimer/$1');

$routes->post('panier/modifier/(:num)', 'Panier::modifier/$1');


//  /**
//  * ROUTES POUR CATEGORIE
//  */
$routes->get('categories/(:num)', 'Categories::filtrerParCategories/$1');


//  /**
//  * ROUTES POUR LOGIN et LOGOUT
//  */
$routes->get('/logout', 'Authentification::logout');

$routes->get('/login', 'Authentification::indexConnexion');






// $routes->get('/', 'Accueil::index');
// $routes->get('/accueil', 'Accueil::index');



// $routes->get('/qui-sommes-nous', 'QuiSommesNous::index');

// $routes->get('/compte', 'Compte::index');
// $routes->get('inscription', 'Inscription::index');

// /**
//  * ROUTES POUR CAREGORIES
//  */
// $routes->get('/categories', 'Categories::index');
// $routes->get('categories/(:num)', 'Categories::filtrerParCategories/$1');


// /**
//  * ROUTES POUR MARQUES
//  */
// $routes->get('/marques', 'Marques::index');
// $routes->get('marques/(:num)', 'Marques::filtrerParMarques/$1');

// /**
//  * ROUTES POUR AGES
//  */
// $routes->get('/ages', 'Ages::index');
//  $routes->get('ages/(:num)', 'Ages::filtrerParAges/$1');

// /**
//  * ROUTES POUR PRODUITS
//  */

//  $routes->get('produit/(:num)', 'Produit::detail/$1');



// /**
//  * ROUTES POUR LES UTILISATEURS
//  */

// $routes->get('/utilisateurs', 'UtilisateurController::clistTousUtilisateurs');

// $routes->get('/utilisateur/(:num)', 'UtilisateurController::cListUnUtilisateur/$1');

// $routes->get('/utilisateur/modifier/(:num)', 'UtilisateurController::cModifUtilisateur/$1');


// $routes->get('/utilisateur/supprimer/(:num)', 'UtilisateurController::cSupprUtilisateur/$1');
