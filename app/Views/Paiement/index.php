<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
       
table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}

th, td {
    text-align: left;
    padding: 12px;
}

th {
    background-color: #4CAF50; 
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd; 
}

td {
    border: 1px solid #ddd; 
}


.status-approved {
    color: green;
    font-weight: bold;
}

.status-pending {
    color: orange;
    font-weight: bold;
}

.status-rejected {
    color: red;
    font-weight: bold;
}

    </style>
</head>
<body>
<h1><?= $title; ?></h1>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;"><?= session()->getFlashdata('success'); ?></p>
<?php elseif (session()->getFlashdata('error')): ?>
    <p style="color: red;"><?= session()->getFlashdata('error'); ?></p>
<?php endif; ?>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID Paiement</th>
            <th>ID Commande</th>
            <th>Montant (€)</th>
            <th>Méthode</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($paiements)): ?>
            <?php foreach ($paiements as $paiement): ?>
                <tr>
                    <td><?= $paiement['paiement_id']; ?></td>
                    <td><?= $paiement['commande_id']; ?></td>
                    <td><?= $paiement['montant']; ?></td>
                    <td><?= htmlspecialchars($paiement['methode']); ?></td>
                    <td><?= htmlspecialchars($paiement['statut']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Aucun paiement trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</body>
</html>
