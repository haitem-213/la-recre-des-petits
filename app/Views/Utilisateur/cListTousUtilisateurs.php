<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
</head>
<body>
    <h1><?= esc($title) ?></h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($utilisateurs as $utilisateur): ?>
        <tr>
            <td><?= esc($utilisateur->id_utilisateur) ?></td>
            <td><?= esc($utilisateur->nomu) ?></td>
            <td><?= esc($utilisateur->prenomu) ?></td>
            <td><?= esc($utilisateur->email) ?></td>
            <td><?= esc($utilisateur->role) ?></td>
            <td>
                <a href="/utilisateur/<?= esc($utilisateur->id_utilisateur, 'url') ?>">Voir</a>
                <a href="/utilisateur/modifier/<?= esc($utilisateur->id_utilisateur, 'url') ?>">Modifier</a>
                <a href="/utilisateur/supprimer/<?= esc($utilisateur->id_utilisateur, 'url') ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>