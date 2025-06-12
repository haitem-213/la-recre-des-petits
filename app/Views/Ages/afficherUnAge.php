<?=$this->extend('layout')?>

<?=$this->section('customtitle')?>
Détails de l'âge<br>
<?=$this->endSection()?>

<?=$this->section('custombody')?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
   
  </div>
</nav>
<br>
<br>
<h1>Détails de l'âge</h1>
<?php if (isset($age) && !empty((array)$age)): ?>
    <p><strong>ID de l'âge:</strong> <?= htmlspecialchars($age->id_age) ?></p>
    <p><strong>Nom de l'âge:</strong> <?= htmlspecialchars($age->noma) ?></p>
<?php else: ?>
    <p>Âge introuvable.</p>
<?php endif; ?>
<?=$this->endSection()?>
