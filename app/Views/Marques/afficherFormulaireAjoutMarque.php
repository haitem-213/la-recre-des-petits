<?= $this->extend('layout') ?>

<?= $this->section('customtitle') ?>
Ajouter une marque<br>
<?= $this->endSection() ?>

<?= $this->section('custombody') ?>
<style>
 
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}


form {
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}


h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}


label {
    font-weight: bold;
    color: #555;
}


input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}


button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}


@media (max-width: 768px) {
    form {
        width: 90%;
    }

    button {
        font-size: 14px;
    }
}
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
 
</nav>
<br>
<br>
<h1>Ajouter une marque</h1>
<?php if (isset($validation)): ?>
    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif; ?>
<form action="<?= base_url('ajouter-marque-formulaire') ?>" method="post">
    <div class="form-group">
        <label for="nomm">Nom de la marque</label>
        <input type="text" class="form-control" id="nomm" name="nomm" value="<?= set_value('nomm') ?>">
    </div>
    
    
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<?= $this->endSection() ?>
