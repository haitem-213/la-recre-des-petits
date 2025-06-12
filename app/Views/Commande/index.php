<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1><?= $title; ?></h1>

    <?php if (!empty($commandes)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur ID</th>
                    <th>Date</th>
                    <th>Situation</th>
                    <th>Total (€)</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td><?= htmlspecialchars($commande['id_commande']); ?></td>
                        <td><?= htmlspecialchars($commande['utilisateur_id']); ?></td>
                        <td><?= htmlspecialchars($commande['date_de_commande']); ?></td>
                        <td><?= htmlspecialchars($commande['statut']); ?></td>
                        <td><?= htmlspecialchars($commande['totalc']); ?></td>
                        <td>
                            <a href="/commande/update/<?= htmlspecialchars($commande['id_commande']); ?>">Modifier</a> |
                            <a href="/commande/delete/<?= htmlspecialchars($commande['id_commande']); ?>" onclick="return confirm('Vous étes sûr?');">Suprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>C'est vide</p>
    <?php endif; ?>
</body>
</html>
