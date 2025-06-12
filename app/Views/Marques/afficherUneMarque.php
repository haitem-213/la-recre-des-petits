<?= $this->extend('layout') ?>

<?= $this->section('customtitle') ?>
Ma marque<br>
<?= $this->endSection() ?>

<?= $this->section('custombody') ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
   
  </div>
</nav>
<br>
<br>
<h1>Ma marque</h1>
<?php if (isset($marque)): ?>
    <p>ID: <?= htmlspecialchars($marque->id_marque) ?></p>
    <p>Nom: <?= htmlspecialchars($marque->nomm) ?></p>
<?php else: ?>
    <p>Marque non trouvée.</p>
<?php endif; ?>
<?= $this->endSection() ?>
