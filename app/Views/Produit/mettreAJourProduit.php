<?=$this->extend('layout')?>

<?=$this->section('customtitle')?>
Mettre à jour le produit<br>
<?=$this->endSection()?>

<?=$this->section('custombody')?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      
    </ul>
  </div>
</nav>
<br>
<br>
<h1>Mettre à jour le produit</h1>
<?php helper('form') ?>
<?= form_open('modifier-produit/'.$produit->id_produit) ?>
<label for="nomp">Nom du produit:</label>
<input type="text" class="form-control" name="nomp" id="nomp" value="<?= set_value('nomp', $produit->nomp) ?>" /><br />
<?= validation_show_error('nomp') ?>

<label for="description">Description:</label>
<textarea class="form-control" name="description" id="description"><?= set_value('description', $produit->description) ?></textarea><br />
<?= validation_show_error('description') ?>

<label for="prix">Prix:</label>
<input type="number" class="form-control" name="prix" id="prix" value="<?= set_value('prix', $produit->prix) ?>" /><br />
<?= validation_show_error('prix') ?>

<label for="stock">Stock:</label>
<input type="number" class="form-control" name="stock" id="stock" value="<?= set_value('stock', $produit->stock) ?>" /><br />
<?= validation_show_error('stock') ?>

<label for="image">URL de l'image:</label>
<input type="text" class="form-control" name="image" id="image" value="<?= set_value('image', $produit->image) ?>" /><br />
<?= validation_show_error('image') ?>

<label for="categorie_id">ID de catégorie:</label>
<input type="number" class="form-control" name="categorie_id" id="categorie_id" value="<?= set_value('categorie_id', $produit->categorie_id) ?>" /><br />
<?= validation_show_error('categorie_id') ?>

<label for="age_id">ID d'âge:</label>
<input type="number" class="form-control" name="age_id" id="age_id" value="<?= set_value('age_id', $produit->age_id) ?>" /><br />
<?= validation_show_error('age_id') ?>

<label for="marque_id">ID de marque:</label>
<input type="number" class="form-control" name="marque_id" id="marque_id" value="<?= set_value('marque_id', $produit->marque_id) ?>" /><br />
<?= validation_show_error('marque_id') ?>



<button type="submit" class="btn btn-primary">Mettre à jour</button>
<?= form_close() ?>
<?=$this->endSection()?>
