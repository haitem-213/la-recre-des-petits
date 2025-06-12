<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produit->nomp ?? 'Produit introuvable') ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 10px;
        }
        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .description {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .not-found {
            font-size: 18px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($produit) && !empty((array)$produit)): ?>
            <h1 class="product-title"><?= htmlspecialchars($produit->nomp) ?></h1>
            <p class="description"><?= htmlspecialchars($produit->description) ?></p>
            <img src="<?= base_url(trim($produit->image, '/')) ?>" alt="Image du produit">
        <?php else: ?>
            <p class="not-found">Produit introuvable.</p>
        <?php endif; ?>
    </div>
</body>
</html>
