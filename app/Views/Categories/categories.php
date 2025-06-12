<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories - La Récré des Petits</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>

    
<header>
            <?php $current_page = 'categories'; ?>
        <?= view('Partials/nav', ['current_page' => $current_page]) ?>
    </header>

    <?= $this->extend('layout-compte') ?>
<?= $this->section('content') ?>

<section class="categories-header">
  <h1>Nos Catégories</h1>
</section>

<section class="categories">
  <?php if (!empty($categories)): ?>
    <?php foreach ($categories as $cat): ?>
      <div class="category">
        <a href="<?= base_url('categories/'.$cat['id_categorie']) ?>">
          <?= esc($cat['nomc']) ?>
        </a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Aucune catégorie disponible.</p>
  <?php endif; ?>
</section>

<?= $this->endSection() ?>
    <!-- PIED DE PAGE -->
    <footer>
        <p>© 2025 La Récré des Petits - Tous droits réservés.</p>
    </footer>

</body>
</html>