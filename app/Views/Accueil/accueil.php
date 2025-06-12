<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - La Récré des Petits</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
    
</head>
<body>


      <header>
        <?php $current_page = 'accueil'; ?>
            <?= view('Partials/nav', ['current_page' => $current_page]) ?>
      </header>

      <?= $this->extend('layout-compte') ?>

      <?= $this->section('content') ?> 

    

   <!-- SECTION HERO VIDEO -->
  <section class="hero-video">
    <video autoplay muted loop class="hero-background-video">
      <source src="public/assets/videos/123.mp4" type="video/mp4">
      Votre navigateur ne supporte pas la vidéo.
    </video>
    <!-- Optionnel : overlay (décommenter si nécessaire)
    <div class="hero-overlay">
      <h1>Bienvenue sur la Fédération JJB</h1>
      <p>La passion du combat, l'excellence technique</p>
    </div>
    -->
  </section>




      <!-- Grille des âges -->
      <section class="age-groups">
    <div class="age-group">
        <a href="<?= base_url('ages/2') ?>">
            <img src="<?= base_url('public/assets/images/ages/2ages.jpeg') ?>" alt="">
            <span class="age-label">0-2 ans</span>
        </a>
    </div>
    <div class="age-group">
        <a href="<?= base_url('ages/3') ?>">
            <img src="<?= base_url('public/assets/images/ages/5ages.jpeg') ?>" alt="">
            <span class="age-label">3-5 ans</span>
        </a>
    </div>
    <div class="age-group">
        <a href="<?= base_url('ages/4') ?>">
            <img src="<?= base_url('public/assets/images/ages/images.jpeg') ?>" alt="">
            <span class="age-label">6-10 ans</span>
        </a>
    </div>
    <div class="age-group">
        <a href="<?= base_url('ages/5') ?>">
            <img src="<?= base_url('public/assets/images/ages/13.jpeg') ?>" alt="">
            <span class="age-label">11-15 ans</span>
        </a>
    </div>
    
</section>





<!--  MEILLEURES VENTES -->
<section class="meilleures-ventes">
    <h2>Nos Meilleures Ventes</h2>
    <div class="produits">
        <div class="produit">
            <img src="public/assets/images/meilleurs_ventes/43259_Prod_en-gb.jpeg" alt="Toboggan Smoby">
            <p class="jouet">Ariel Tournoyante</p>
            <p class="marques">_____</p>
            <p class="marques"></p>
            <a href="<?= site_url('panier/ajouter/16') ?>" class="ajouter-panier">Ajouter au panier</a>
        </div>
        <div class="produit">
            <img src="public/assets/images/meilleurs_ventes/75351.jpeg" alt="Déguisement Sonic">
            <p class="jouet">Le casque de la Princesse Leila(TM)</p>
            <p class="marques">_____</p>
            <a href="<?= site_url('panier/ajouter/26') ?>" class="ajouter-panier">Ajouter au panier</a>
        </div>
        <div class="produit">
            <img src="public/assets/images/meilleurs_ventes/31215_Prod_en-gb.jpeg" alt="Pâte à modeler Play-Doh">
            <p class="jouet">Les Tournesols </p>
            <p class="marques">_____</p>
            <a href="<?= site_url('panier/ajouter/36') ?>" class="ajouter-panier">Ajouter au panier</a>
        </div>
        <div class="produit">
            <img src="public/assets/images/meilleurs_ventes/10368_Prod.jpeg" alt="Quad électrique">
            <p class="jouet">Le chrysanthéme</p>
            <p class="marques">_____</p>
            <a href="<?= site_url('panier/ajouter/32') ?>" class="ajouter-panier">Ajouter au panier</a>
        </div>
    </div>
</section>


    <?= $this->endSection() ?>
    <!--  PIED DE PAGE -->
    <footer>
        <p>© 2025 La Récré des Petits - Tous droits réservés.</p>
    </footer>
  <!-- Script externe -->
  
</body>
</html>