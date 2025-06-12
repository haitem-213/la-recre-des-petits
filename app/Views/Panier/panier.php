<?= $this->extend('layout-compte') ?>
<?= $this->section('content') ?>

<style>

.produits-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-around;
}


.produit-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    background-color: #f9f9f9;
    width: 300px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}


.produit-item img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 15px;
}


.produit-details h2 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

.produit-details .produit-status {
    font-size: 16px;
    color: #27ae60;
    margin-bottom: 10px;
}

.produit-details .produit-prix {
    font-size: 24px;
    font-weight: bold;
    color: #e74c3c; 
    margin-bottom: 15px;
}


.produit-actions {
    margin-top: 15px;
    text-align: center;
}

.produit-actions form {
    display: inline-block;
    margin: 5px;
}

.produit-actions input[type="number"] {
    padding: 5px;
    font-size: 14px;
    width: 60px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.produit-actions .btn-modifier {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 5px 10px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.produit-actions .btn-modifier:hover {
    background-color: #388E3C;
}

.produit-actions .btn-supprimer {
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 12px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.produit-actions .btn-supprimer:hover {
    background-color: #c0392b;
}


.total-panier {
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    color: black;
}

.payment-button {
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 60px;
    font-size: 16px;
    cursor: pointer;
    display: block;
    margin: 20px auto;
    transition: background-color 0.3s ease;
}

.payment-button:hover {
    background-color: #2980b9;
}

h1 {
    text-align: center;
}
</style>

<?php
$totalGeneral = 0; 
?>

<section class="panier-header">
    <h1>Mon Panier</h1>
</section>

<div class="produits-container">
    <?php if (!empty($panier)): ?>
        <?php foreach ($panier as $item): ?>
            <?php
     
            $sousTotal = $item['prix'] * $item['quantite'];
            $totalGeneral += $sousTotal; 
            ?>
            <div class="produit-item">
                <img src="<?= base_url($item['image']) ?>" alt="<?= esc($item['nomp']) ?>">
                <div class="produit-details">
                    <h2><?= esc($item['nomp']) ?></h2>
                    <p class="produit-status">Statut: Disponible</p>
                    <p class="produit-prix"><?= number_format($item['prix'], 2, ',', ' ') ?> €</p>
                </div>
                <div class="produit-actions">
                    <form method="post" action="<?= base_url('panier/modifier/' . $item['id']) ?>">
                        <input type="number" id="quantite" name="quantite" value="<?= esc($item['quantite']) ?>" min="1">
                        <button type="submit" class="btn-modifier">Modifier</button>
                    </form>
                    <form method="post" action="<?= base_url('panier/supprimer/' . $item['id']) ?>">
                        <button type="submit" class="btn-supprimer">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
</div>

<div class="total-panier">
    <p>Total général : <strong><?= number_format($totalGeneral, 2, ',', ' ') ?> €</strong></p>
</div>

<div>
   <form method="post" action="<?= base_url('paiement-create') ?>">
    <input type="hidden" name="utilisateur_id" value="<?= esc(session()->get('user_id')) ?>">
    <input type="hidden" name="totalc" value="<?= esc($totalGeneral) ?>">
    <button type="submit" class="payment-button">Paiement</button>
</form>

</div>

<?= $this->endSection() ?>
