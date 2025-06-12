<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
</head>
<body>
    <h1><?= esc($title) ?></h1>
    <p>ID: <?= esc($utilisateur->id_utilisateur) ?></p>
    <p>Nom: <?= esc($utilisateur->nom) ?></p>
    <p>Prénom: <?= esc($utilisateur->prenom) ?></p>
    <p>Pseudo: <?= esc($utilisateur->pseudo) ?></p>
    <p>Email: <?= esc($utilisateur->email) ?></p>
    <p>Role: <?= esc($utilisateur->role) ?></p>
    <a href="/utilisateurs">Retour à la liste</a>
</body>
</html>
