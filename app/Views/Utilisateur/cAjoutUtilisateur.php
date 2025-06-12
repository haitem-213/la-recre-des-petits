<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h1><?= esc($title) ?></h1>

    <!-- Afficher les messages de succès -->
    <?php if (session()->has('success')): ?>
        <p style="color: green;"><?= session('success') ?></p>
    <?php endif; ?>

    <!-- Formulaire d'ajout d'utilisateur -->
    <form action="/utilisateur/traiter-ajout" method="post">
        <!-- Champ Nom -->
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?= old('nom') ?>">
        <?php if (session()->has('errors.nom')): ?>
            <span class="error"><?= session('errors.nom') ?></span>
        <?php endif; ?>
        <br>

        <!-- Champ Prénom -->
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="<?= old('prenom') ?>">
        <?php if (session()->has('errors.prenom')): ?>
            <span class="error"><?= session('errors.prenom') ?></span>
        <?php endif; ?>
        <br>

        <!-- Champ Pseudo -->
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" id="pseudo" value="<?= old('pseudo') ?>">
        <?php if (session()->has('errors.pseudo')): ?>
            <span class="error"><?= session('errors.pseudo') ?></span>
        <?php endif; ?>
        <br>

        <!-- Champ Email -->
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?= old('email') ?>">
        <?php if (session()->has('errors.email')): ?>
            <span class="error"><?= session('errors.email') ?></span>
        <?php endif; ?>
        <br>

        <!-- Champ Rôle -->
        <label for="role">Rôle :</label>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <?php if (session()->has('errors.role')): ?>
            <span class="error"><?= session('errors.role') ?></span>
        <?php endif; ?>
        <br>

        <!-- Champ Mot de passe -->
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe">
        <?php if (session()->has('errors.mot_de_passe')): ?>
            <span class="error"><?= session('errors.mot_de_passe') ?></span>
        <?php endif; ?>
        <br>

        <!-- Bouton de soumission -->
        <button type="submit">Ajouter</button>
    </form>

    <!-- Lien vers la liste des utilisateurs -->
    <p><a href="/utilisateurs">Retour à la liste des utilisateurs</a></p>
</body>
</html>