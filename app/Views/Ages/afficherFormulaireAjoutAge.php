<?= $this->extend('layout') ?>

<?= $this->section('customtitle') ?>
Ajouter un âge
<?= $this->endSection() ?>

<?= $this->section('custombody') ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
</nav>
<br><br>

<h1>Ajouter un âge</h1>

<?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('ajouter-age') ?>" method="post">
    <div class="form-group">
        <label for="noma">Nom de l'âge</label>
        <input type="text" class="form-control" id="noma" name="noma" value="<?= set_value('noma') ?>">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<?= $this->endSection() ?>
