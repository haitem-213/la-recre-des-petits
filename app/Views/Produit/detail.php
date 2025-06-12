<?= $this->extend('layout-compte') ?>

<?= $this->section('content') ?>

  <section class="produit-detail">
    <a href="javascript:history.back()" class="btn-back">Retour aux produits</a>
    <div class="produit-detail-container">
      <!-- Image du produit -->
      <div class="produit-image">
        <img src="<?= base_url($produit->image) ?>" alt="<?= esc($produit->nomp) ?>">
      </div>
      
      <!-- Détails du produit -->
      <div class="produit-info">
        <h1><?= esc($produit->nomp) ?></h1>

        <p class="prix"><?= esc($produit->prix) ?> €</p>
         <!--Bouton pour la description du produit -->
         <button class="toggle-desc btn-toggle">Voir la description</button>
         <div class="description">
             <p><?= esc($produit->description) ?></p>
        </div>
     
       
        <!--Bouton d'ajout au panier -->

        <a href="<?= site_url('panier/ajouter/'.$produit->id_produit)?>"
         class="ajouter-panier">Ajouter au panier</a>
      </div>
    </div>
  </section>
<?= $this->endSection() ?>
          <?= site_url('panier/ajouter/'.$produit->id_produit)?>"
          <a class="ajouter-panier">Ajouter au panier</a>

      </div>
    </div>
  </section>
<?= $this->endSection() ?>