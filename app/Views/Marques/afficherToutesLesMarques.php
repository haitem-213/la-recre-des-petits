<?= $this->extend('layout') ?>

<?= $this->section('customtitle') ?>
Liste de toutes les marques<br>
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
<h1>Liste de toutes les marques</h1>
<?php if (isset($marques) && !empty($marques)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
<?php foreach ($marques as $marque): ?>
<tr>
    <td><?= htmlspecialchars($marque->id_marque) ?></td>
    <td><?= htmlspecialchars($marque->nomm) ?></td>
    <td>
        <a href="<?= site_url('modifier-marque/'.$marque->id_marque) ?>" class="btn btn-warning">Modifier</a>
        <a href="<?= site_url('supprimer-marque/'.$marque->id_marque) ?>" class="btn btn-danger">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>

        </tbody>
    </table>
<?php else: ?>
    <p>Aucune marque trouvée.</p>
<?php endif; ?>
<?= $this->endSection() ?>
