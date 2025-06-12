<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits par Âge</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 10px;
    padding: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.produits {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    width: 99%;
}

.produit {
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
    align-items: stretch;
    border: 1px solid #ccc;
    text-align: center;
    background-color: white;
    height: 450px; 
    padding: 10px;
    box-sizing: border-box;
    overflow: hidden; 
}

.produit h2 {
    height: 50px;
    line-height: 25px;
    overflow: hidden;
    text-overflow: ellipsis; 
    white-space: nowrap;
}

.produit img {
    width: auto;
    max-height: 200px; 
    object-fit: contain;
    margin-bottom: 10px;
}

.produit p {
    margin: 5px 0;
    font-size: 14px;
    line-height: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3; 
    -webkit-box-orient: vertical;
}

.ajouter-panier {
    color: white;
    width: 90%;
    padding: 8px;
    margin-top: auto; 
    background-color: #FF5500;
    text-align: center;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    display: block;
    transition: background-color 0.3s ease;
}

.ajouter-panier:hover {
    background-color: #cc4400; 
}


@media (max-width: 768px) {
    .produits {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .produits {
        grid-template-columns: 1fr;
    }

    .produit {
        height: auto; 
    }
}

    </style>
</head>

<body>
    <?php if (!empty($produits)): ?>
    <div class="produits">
        <?php foreach ($produits as $produit): ?>
        <div class="produit">
            <h2><?= htmlspecialchars($produit->nomp) ?></h2>
            <img src="<?= base_url(htmlspecialchars($produit->image)) ?>" alt="<?= htmlspecialchars($produit->nomp) ?>">
            <p><?= htmlspecialchars($produit->description) ?></p>
            <p>Prix : <?= htmlspecialchars($produit->prix) ?>€</p>
            
            <a href="<?= site_url('panier/ajouter/'.$produit->id_produit)?>"
         class="ajouter-panier">Ajouter au panier</a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p>Aucun produit trouvé pour cette catégorie d'âge.</p>
    <?php endif; ?>
</body>

</html>
