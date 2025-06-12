<link rel="stylesheet" href="public/assets/css/style.css">

<?php 
$session = session();
$panier = $session->get('panier') ?? [];
$nbArticles = 0;
foreach ($panier as $item) {
    $nbArticles += $item['quantite'];
}
$data['nbArticles'] = $nbArticles;
?>

<?php
// On récupère la variable $current_page passée depuis la vue
$current_page = isset($current_page) ? $current_page : '';
?>
<nav>
  <div class="left">
    <div class="logo">
      <a href="<?= base_url('/') ?>"><img src="public/assets/images/logo/logo_site.jpg" alt="La Récré des Petits"></a>
    </div>
    <ul class="menu">
      <?php if ($current_page !== 'accueil'): ?>
        <li><a href="<?= base_url('/') ?>">Accueil</a></li>
      <?php endif; ?>
      
      <?php if ($current_page !== 'categories'): ?>
        <li><a href="<?= base_url('categories') ?>">Catégories</a></li>
      <?php endif; ?>
      
      <?php if ($current_page !== 'ages'): ?>
        <li><a href="<?= base_url('ages') ?>">Âges</a></li>
      <?php endif; ?>
      
      <?php if ($current_page !== 'marques'): ?>
        <li><a href="<?= base_url('marques') ?>">Marques</a></li>
      <?php endif; ?>
      
      <?php if ($current_page !== 'qui-sommes-nous'): ?>
        <li><a href="<?= base_url('qui-sommes-nous') ?>">Qui sommes-nous ?</a></li>
      <?php endif; ?>
    </ul>
  </div>
  <div class="icons">
    <a href="<?= base_url('panier') ?>">🛒</a>
    
    <?php if (session()->has('logged_in')): ?>
      <a href="<?= base_url('/logout') ?>" class="logout-btn">Déconnexion</a>
    <?php else: ?>
      <a href="javascript:void(0)" class="open-modal">👤</a>
    <?php endif; ?>
  </div>
</nav>

<style>

nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f8f9fa;
  padding: 10px 20px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

nav .logo img {
  height: 50px;
}

nav .menu {
  list-style: none;
  display: flex;
  gap: 20px;
  margin: 0;
  padding: 0;
}

nav .menu li a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  transition: color 0.3s ease;
}

nav .menu li a:hover {
  color: #007bff; 
}

nav .icons {
  display: flex;
  align-items: center;
  gap: 20px;
}

.icons a {
  text-decoration: none;
  font-size: 1.5rem;
}

.logout-btn {
    color: #fff;
    background-color: #dc3545; 
    padding: 5px 10px; 
    font-size: 0.9rem; 
    border-radius: 3px; 
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.logout-btn:hover {
    background-color: #b02a37; 
}

.open-modal {
  background-color: #007bff; 
}

.open-modal:hover {
  background-color: #0056b3;
}
</style>
