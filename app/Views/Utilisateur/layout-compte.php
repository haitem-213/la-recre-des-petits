<?php 
// Nom du fichier : layout-compte.php
// Ce fichier est le modèle pour s'inscrire ou se loguer.
?>

<?php $session = session();
$panier = $session->get('panier') ?? [];
$nbArticles = 0;
foreach ($panier as $item) {
    $nbArticles += $item['quantite'];
}
$data['nbArticles'] = $nbArticles;
?>

<?= $this->extend('layout') ?>
   


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= isset($title) ? $title : 'La Récré des Petits' ?></title>
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style-inscription.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style-compte.css') ?>">


</head>


<body>

    <!-- Bande d'annonce défilante -->
    <div class="announcement">
            <p>🪀 🛹 🧩 🎮 🧸 🎲 Livraison gratuite - Découvrez nos nouveautés ! 🪀 🛹 🧩 🎮 🧸</p>

        </div>

        


  <?=   view('Partials/nav', ['current_page' => $current_page ?? '']) ?>
 
  <?= $this->renderSection('content') ?>

  <!-- Affichage des messages de succès ou d'erreur sinon pas d'affichage de message-->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

  <!-- Inclusion de la modale -->
  <div id="overlay" class="overlay"></div>
  <div id="modalCompte" class="modal">
    <div class="modal-header">
      <h2>Connectez-vous</h2>
      <span id="closeModalBtn" class="close">&times;</span>
    </div>
    <div class="modal-content">
      <p>Connectez-vous à votre compte pour profiter de tous nos services.</p>
      <form action="<?= base_url('/log-utilisateur') ?>" method="post">

        <label for="email">Adresse e-mailaaaaaaaaaaaaa</label>
        <input type="email" id="email" name="email" placeholder="exemple@domaine.com" required>

        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="••••••" 
        required autocomplete="current-password">


        <button type="submit" class="btn-login">Connexion</button>
      </form>
      <div class="modal-links">
        <p>Vous n’avez pas de compte ? <a href="<?= base_url('/inscription') ?>">Inscrivez-vous</a></p>
        <p><a href="#">Mot de passe oublié ?</a></p>
      </div>
    </div>
  </div>

  <footer>
    <p>© 2025 La Récré des Petits - Tous droits réservés.</p>
  </footer>

  <script src="<?= base_url('public/assets/js/script.js') ?>"></script>
</body>
</html>