<h1>Effectuer un Paiement</h1>
<form method="post" action="<?= base_url('paiement-create') ?>">
    <label for="commande_id">Commande ID:</label>
    <input type="number" name="commande_id" required>
    <label for="montant">Montant:</label>
    <input type="text" name="montant" required>
    <label for="methode">Méthode:</label>
    <select name="methode" required>
        <option value="Carte">Carte Bancaire</option>
        <option value="Paypal">PayPal</option>
    </select>
    <button type="submit">Payer</button>
</form>
