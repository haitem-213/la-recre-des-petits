<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid;
            border-radius: 5px;
        }
        .alert-success {
            color: green;
            background-color: #e7f6e7;
            border-color: green;
        }
        .alert-error {
            color: red;
            background-color: #fce7e7;
            border-color: red;
        }
    </style>
</head>
<body>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<?php if (empty($commande)): ?>
    <p>Les informations de commande sont introuvables. Veuillez réessayer avec un ID valide.</p>
<?php else: ?>
    <form action="/commande/update/<?= $commande['id_commande']; ?>" method="post">
        <?= csrf_field(); ?>

        <label for="utilisateur_id">ID Utilisateur :</label>
        <input type="text" name="utilisateur_id" id="utilisateur_id" value="<?= htmlspecialchars($commande['utilisateur_id']); ?>" readonly>

        <label for="statut">Statut de la commande :</label>
        <select name="statut" id="statut" required>
            <option value="En attente" <?= $commande['statut'] === 'En attente' ? 'selected' : ''; ?>>En attente</option>
            <option value="En cours" <?= $commande['statut'] === 'En cours' ? 'selected' : ''; ?>>En cours</option>
            <option value="Livré" <?= $commande['statut'] === 'Livré' ? 'selected' : ''; ?>>Livré</option>
            <option value="Annulé" <?= $commande['statut'] === 'Annulé' ? 'selected' : ''; ?>>Annulé</option>
        </select>

        <label for="totalc">Total (€) :</label>
        <input type="number" name="totalc" id="totalc" value="<?= htmlspecialchars($commande['totalc']); ?>" step="0.01" required>

        <button type="submit">Mettre à jour la commande</button>
    </form>
<?php endif; ?>

</body>
</html>
