<?= $this->extend('layout') ?>

<?= $this->section('metadescription') ?>
<meta name="description" content="Inscrivez-vous sur La Récré des Petits pour accéder à nos services exclusifs.">
<?= $this->endSection() ?>

<?= $this->section('customcss') ?>
<link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/assets/css/style-inscription.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('customtitle') ?>
Inscription - La Récré des Petits
<?= $this->endSection() ?>

<?= $this->section('custombody') ?>
<main>
  <?= view('Partials/nav', ['current_page' => $current_page ?? '']) ?>

  <section class="inscription">
    <h1>Inscription</h1>

    <!-- Affichage des messages d'erreur ou de succès -->
    <?php if (session()->has('error')): ?>
        <div style="color: red;">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('success')): ?>
        <div style="color: green;">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?= form_open('inscription') ?>

    <label for="prenomu">Prénom</label>
      <input type="text" name="prenomu" id="prenomu" required>
      <?= validation_show_error('prenomu') ?>

      <label for="nomu">Nom</label>
      <input type="text" name="nomu" id="nomu" required>
      <?= validation_show_error('nomu') ?>

      

      <label for="email">Adresse e-mail</label>
      <input type="email" name="email" id="email" required>
      <?= validation_show_error('email') ?>

      <label for="mot_de_passe">Mot de passe</label>
      <input type="password" name="mot_de_passe" id="mot_de_passe" required>
      <?= validation_show_error('mot_de_passe') ?>

      <label for="confirm_mot_de_passe">Confirmez le mot de passe</label>
      <input type="password" name="confirm_mot_de_passe" id="confirm_mot_de_passe" required>

      <button type="submit">S'inscrire</button>
    <?= form_close() ?>
  </section>
</main>
<?= $this->endSection() ?>

<?= $this->section('customjs') ?>
<!-- Ajoutez des scripts JS spécifiques à cette page si nécessaire -->
<?= $this->endSection() ?>