<?=$this->extend('layout')?>

<?=$this->section('customtitle')?>
Supprimer le produit<br>
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
<h1>Supprimer le produit</h1>
<p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>
<?php helper('form') ?>
<?= form_open('supprimer-produit/'.$produit->id_produit) ?>
<button type="submit" class="btn btn-danger">Oui, supprimer</button>
<a href="/produits" class="btn btn-secondary">Non, retourner</a>
<?= form_close() ?>
<?=$this->endSection()?>
