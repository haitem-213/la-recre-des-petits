<?= $this->extend('layout-compte') ?>
<?= $this->section('content') ?>

<style>
  .produits {
    
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 150px; 
    margin-top: 20px;
    width: 100%; 
    max-width: 1400px; 
}


.produit {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #ccc;
    background-color: white;
    padding: 20px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    border-radius: 10px;
    height: 500px; 
    width: 100%; 
}

.produit img {
    width: auto;
    max-height: 200px; 
    object-fit: contain;
    margin-bottom: 15px; 
}

.produit h3 {
    font-size: 20px; 
    color: #333;
    margin-bottom: 15px;
    text-align: center;
}

.produit p.prix {
    font-size: 18px; 
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

.produit .ajouter-panier {
    display: inline-block;
    padding: 10px 20px; 
    color: white;
    background-color: #FF5500;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    margin-top: auto; 
}

.produit .ajouter-panier:hover {
    background-color: #cc4400;
}



.btn-back {
    display: inline-block;
    padding: 8px 15px;
    margin: 20px auto;
    color: white;
    background-color: #007BFF;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-back:hover {
    background-color: #0056b3;
}
</style>

<section class="categories-header">
  <a href="<?= base_url('categories') ?>" class="btn-back">Retour aux catégories</a>
  <h1>Produits pour <?= esc($categorieName) ?></h1>
</section>

<section class="produits">
  <?php if (!empty($produits)): ?>
    <?php foreach ($produits as $prod): ?>
      <div class="produit">
      <a href="<?= base_url('produit/'.$prod->id_produit)?>" class="lien-produit">
            <img src="<?= base_url($prod->image) ?>" alt="<?= esc($prod->nomp) ?>">
            <h3><?= esc($prod->nomp) ?></h3>
            
            <p class="prix"><?= esc($prod->prix) ?> €</p>
        </a>

        <!--Bouton d'ajout au panier -->

        <a href="<?= site_url('panier/ajouter/'.$prod->id_produit)?>"
        class="ajouter-panier">Ajouter au panier</a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Aucun produit trouvé pour cette catégorie.</p>
  <?php endif; ?>
</section>

<?= $this->endSection() ?>