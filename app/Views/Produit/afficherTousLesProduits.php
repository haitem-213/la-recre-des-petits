<style>
.table-container {
    margin: 20px auto;
    width: 90%;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
    font-weight: bold;
}

tr:hover {
    background-color: #f9f9f9;
}

.img-cell img {
    width: 100px;
    height: auto;
}
</style>

<div class="table-container">
    <h2>Liste de tous les produits</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Categorie</th>
                <th>Age</th>
                <th>Marque</th>
                <th>Date de création</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach($produits as $produit): ?>
            <tr>
                <td class="img-cell">
                    <img src="<?= $produit->image ?>" alt="Image du produit">
                </td>
                <td><?= $produit->nomp ?></td>
                <td><?= substr($produit->description, 0, 100) ?>...</td>
                <td><?= number_format($produit->prix, 2) ?>€</td>
                <td><?= isset($produit->categorie_id) ? $produit->categorie_id : 'Null'; ?></td>
            
                <td><?= isset($produit->age_id) ? $produit->age_id : 'Null'; ?></td>
                <td><?= isset($produit->marque_id) ? $produit->marque_id : 'Null'; ?></td>

                <td><?= $produit->date_de_creation ?></td>
                <td>
                    <a href="<?= site_url('modifier-produit/'.$produit->id_produit) ?>" class="btn btn-primary btn-sm">Modifier</a>
                    <a href="<?= site_url('supprimer-produit/'.$produit->id_produit) ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>

            
 
        </tbody>
    </table>
</div>
