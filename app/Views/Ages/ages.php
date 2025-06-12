<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Âges - La Récré des Petits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: #ff6347;
            padding: 20px 10px; 
            color: white;
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0; 
            font-size: 1rem;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .age-group img {
            width: 180px; 
            height: 180px; 
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .age-group img:hover {
            transform: scale(1.05);
        }

        .age-label {
            display: block;
            margin-top: 10px;
            font-size: 1.2rem;
            color: #333;
            font-weight: bold;
        }

        .produits {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px;
        }

        .produit {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        section.produit img {
    width: 480px;
    height: 480px;
    object-fit: cover;
}

        .produit img {
            width: 480px;
            height: 4800px; 
            object-fit: cover;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .produit:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .ajouter-panier {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #ff6347;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .ventes-par-ages h2{
            text-align: center;
        }

        .ajouter-panier:hover {
            background-color: #e55337;
        }

        @media (max-width: 768px) {
            .produits {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .produits {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<header>
    <?= view('Partials/nav', ['current_page' => 'ages']) ?>
</header>

<?= $this->extend('layout-compte') ?>

<?= $this->section('content') ?> 
<br>
<br>
<br>
<section class="age-groups">
    <div class="age-group">
        <a href="<?= base_url('ages/2') ?>">
            <img src="<?= base_url('public/assets/images/ages/2ages.jpeg') ?>" alt="0-2 ans">
            <span class="age-label">0-2 ans</span>
        </a>
    </div>
    <div class="age-group">
        <a href="<?= base_url('ages/3') ?>">
            <img src="<?= base_url('public/assets/images/ages/5ages.jpeg') ?>" alt="3-5 ans">
            <span class="age-label">3-5 ans</span>
        </a>
    </div>
    <div class="age-group">
        <a href="<?= base_url('ages/4') ?>">
            <img src="<?= base_url('public/assets/images/ages/images.jpeg') ?>" alt="6-10 ans">
            <span class="age-label">6-10 ans</span>
        </a>
    </div>
    <div class="age-group">
        <a href="<?= base_url('ages/5') ?>">
            <img src="<?= base_url('public/assets/images/ages/13.jpeg') ?>" alt="11-15 ans">
            <span class="age-label">11-15 ans</span>
        </a>
    </div>
</section>
<br>
<br>
<br>
<br>
<br>

<section class="ventes-par-ages">

    <div class="produits">
        <div class="produit">
            <img src="public/assets/images/0-2-ans/21355_Prod.jpeg" alt="L'évolution des STIM">
            <p>L'évolution des STIM</p>
            <p>_</p>
            <a href="<?= site_url('panier/ajouter/7') ?>" class="ajouter-panier">Ajouter au panier</a>
        </div>
        <div class="produit">
            <img src="public/assets/images/3-5-ans/21342.jpeg" alt="La collection d'insectes">
            <p>La collection d'insectes</p>
            <p>_</p>
            <a href="<?= site_url('panier/ajouter/15') ?>" class="ajouter-panier">Ajouter au panier</a>
        </div>
        <div class="produit">
            <img src="public/assets/images/6-10-ans/21344_alt3.jpeg" alt="Le Seigneur Des Anneux">
            <p>Le Seigneur Des Anneux</p>
            <p>_</p>
            <a href="<?= site_url('panier/ajouter/29') ?>" class="ajouter-panier">Ajouter au panier</a>
        </div>
        <div class="produit">
            <img src="public/assets/images/11-15-ans/31208.jpeg" alt="Hokusai – La Grande vague">
            <p>Hokusai – La Grande vague</p>
            <p>_</p>
            <a href="<?= site_url('panier/ajouter/34') ?>" class="ajouter-panier">Ajouter au panier</a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<footer>
    <p>© 2025 La Récré des Petits - Tous droits réservés.</p>
</footer>

</body>
</html>
