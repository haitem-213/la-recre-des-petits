<?= $this->extend('layout') ?>

<?= $this->section('customtitle') ?>
Echec
<?= $this->endSection() ?>

<?= $this->section('custombody') ?>
<div class='alert alert-danger' role='alert'>
    <?= isset($message) ? esc($message) : 'Echec' ?>
</div>
<?= $this->endSection() ?>
