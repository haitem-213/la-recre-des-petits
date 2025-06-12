<?= $this->extend('layout') ?>

<?= $this->section('metadescription') ?>
<meta name="description"
  content="Remplissez votre profile sur La Récré des Petits pour accéder à nos services exclusifs.">
<?= $this->endSection() ?>

<?= $this->section('customcss') ?>
<link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/assets/css/style-profil.css') ?>">
<?= $this->endSection() ?>


<?= $this->section('customtitle') ?>
Profil - La Récré des Petits
<?= $this->endSection() ?>

<?= $this->section('custombody') ?>
<!-- CONTENU PRINCIPAL -->

<?= view('Partials/nav', ['current_page' => $current_page ?? '']) ?>

<section class="profil-section">
  <h1>Complétez votre profil</h1>
  <?php if (session()->has('success')): ?>
    <p class="success-message"><?= session('success') ?></p>
  <?php endif; ?>

  <?php if (session()->has('error')): ?>
    <p class="error-message"><?= session('error') ?></p>
  <?php endif; ?>

  <form action="<?= base_url('/completer-profil') ?>" method="post">







    <!-- Afficher l'ID utilisateur -->
    <div class="form-group">
      <label for="id_utilisateur">ID Utilisateur :</label>
      <input type="text" name="id_utilisateur" id="id_utilisateur" value="<?= old('id_utilisateur', $utilisateur['id_utilisateur'] ?? '') ?>" readonly>
    </div>

    <div class="form-group">
      <label for="societe">Société :</label>
      <input type="text" name="societe" id="societe" value="<?= old('societe', $utilisateur['societe'] ?? '') ?>"
      >
      <?= validation_show_error('societe') ?>
      <br>
    </div>


    <div class="form-group">
      <label for="nomu">Nom</label>
      <input type="text" name="nomu" id="nomu" value="<?= old('nomu', $utilisateur['nomu'] ?? '') ?>" readonly>
      <?= validation_show_error('nomu') ?>
      <br>
    </div>


    <div class="form-group">
      <!-- Champ Prénom -->
      <label for="prenomu">Prénom</label>
      <input type="text" name="prenomu" id="prenomu" value="<?= old('prenomu', $utilisateur['prenomu'] ?? '') ?>"
      readonly>
      <?= validation_show_error('prenomu') ?>
      <br>
    </div>

    <div class="form-group">
      <label for="email">Adresse e-mail</label>
      <input type="text" name="email" id="email" value="<?= old('email', $utilisateur['email'] ?? '') ?>" readonly>
      <?= validation_show_error('email') ?>
      <br>
    </div>

    <div class="form-group">
      <label for="role">Rôle :</label>
      <input type="text" name="role" id="role" value="<?= old('role', $utilisateur['role'] ?? '') ?>" readonly>
      <?= validation_show_error('role') ?>
      <br>
    </div>


    <div class="form-group">
      <label for="telephone">Téléphone :</label>
      <input type="text" name="telephone" id="telephone" value="<?= old('telephone', $utilisateur['telephone'] ?? '') ?>"
        required>
      <?= validation_show_error('telephone') ?>
      <br>
    </div>

    <div class="form-group">
      <label for="adresse1">Adresse 1 :</label>
      <input type="text" name="adresse1" id="adresse1" value="<?= old('adresse1', $utilisateur['adresse1'] ?? '') ?>"
        required>
      <?= validation_show_error('adresse1') ?> <br>
    </div>

    <div class="form-group">
      <label for="adresse2">Adresse 2 :</label>
      <input type="text" name="adresse2" id="adresse2" value="<?= old('adresse2', $utilisateur['adresse2'] ?? '') ?>"
      <?= validation_show_error('adresse2') ?>> <br>
    </div>


    <div class="form-group">
      <label for="ville">Ville :</label>
      <input type="text" name="ville" id="ville" value="<?= old('ville', $utilisateur['ville'] ?? '') ?>" required>
      <?= validation_show_error('ville') ?> <br>
    </div>

    <div class="form-group">
      <label for="code_postal">Code Postal :</label>
      <input type="text" name="code_postal" id="code_postal"
      value="<?= old('code_postal', $utilisateur['code_postal'] ?? '') ?>" required>
      <?= validation_show_error('code_postal') ?> <br>
    </div>

    <button type="submit" class="btn-submit">Mettre à jour</button>
  </form>




  <!-- FOOTER -->
  <footer>
    <p>© 2025 La Récré des Petits - Tous droits réservés.</p>
  </footer>


  <?= $this->endSection() ?>