<?=$this->extend('layout')?>

<?=$this->section('customtitle')?>
Supprimer l'âge<br>
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
<h1>Supprimer l'âge</h1>
<p>Êtes-vous sûr de vouloir supprimer cet âge ?</p>
<?php helper('form') ?>
<?= form_open('supprimer-age/'.$age->id_age) ?>
<button type="submit" class="btn btn-danger">Oui, supprimer</button>
<a href="/ages" class="btn btn-secondary">Non, retourner</a>
<?= form_close() ?>
<?=$this->endSection()?>

