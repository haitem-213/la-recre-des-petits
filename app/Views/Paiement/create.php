<h1>Créer un nouveau paiement</h1>
<?php if (isset($validation)): ?>
    <div class="error">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('paiement/create') ?>">
    <input type="text" name="commande_id" placeholder="Commande ID">
    <input type="text" name="montant" placeholder="Montant">
    <input type="text" name="methode" placeholder="Méthode">
    <input type="text" name="statut" placeholder="Statut">
    <button type="submit">Créer</button>
</form>
