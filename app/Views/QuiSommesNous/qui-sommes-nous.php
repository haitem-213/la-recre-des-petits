<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qui sommes-nous - La Récré des Petits</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>

      

<header>
      <?php $current_page = 'qui-sommes-nous'; ?>
            <?= view('Partials/nav', ['current_page' => $current_page]) ?>
</header>
       
<?= $this->extend('layout-compte') ?>

<?= $this->section('content') ?> 

    <!-- ✅ Titre principal -->
    <section class="about-header">
        <h1>À propos de La Récré des Petits</h1>
    </section>

    <!-- ✅ Présentation de l'entreprise -->
    <section class="about">
        <div class="about-text">
            <p><br>La Récré des Petits est une boutique en ligne dédiée aux jouets de qualité, conçus pour éveiller l’imagination et le développement des enfants. <br>Nous nous engageons à offrir des produits sûrs, éducatifs et amusants.</p>
        </div>
        <div class="about-image">
            <img src="images/about.jpg" alt="À propos de nous">
        </div>
    </section>

    <!-- ✅ Nos valeurs -->
    <section class="values">
        <h2>Nos valeurs</h2>
        <div class="value-list">
            <div class="value">🎯 Qualité</div>
            <div class="value">🌱 Responsabilité</div>
            <div class="value">🎁 Plaisir d'offrir</div>
        </div>
    </section>

    <!-- ✅ Engagements -->
    <section class="engagement">
        <h2>Notre Engagement</h2>
      
        <p>Nous sélectionnons avec soin des jouets qui respectent les normes de sécurité et favorisent le développement des enfants.</p>
    </section>
    <?= $this->endSection() ?>
    <!-- ✅ PIED DE PAGE -->
    <footer>
        <p>© 2025 La Récré des Petits - Tous droits réservés.</p>
    </footer>

</body>
</html>