<?=$this->extend('layout')?>

<?=$this->section('customtitle')?>
Liste de tous les âges<br>
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
<h1>Liste de tous les âges</h1>
<?php if (isset($ages) && !empty($ages)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ages as $age): ?>
                <tr>
                <td><?= htmlspecialchars($age['id_age']) ?></td>
                <td><?= htmlspecialchars($age['noma']) ?></td>

                    <td>
                        <a href="<?= site_url('maj-age/'.$age['id_age']) ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="<?= site_url('supprimer-age/'.$age['id_age']) ?>" class="btn btn-danger btn-sm">Supprimer</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun âge trouvé.</p>
<?php endif; ?>
<?=$this->endSection()?>

