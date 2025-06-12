<h1>Mettre à jour l'âge</h1>
<?= form_open('modifier-age/'.$age->id_age) ?>
<label for="noma">Nom de l'âge:</label>
<input type="text" name="noma" id="noma" value="<?= set_value('nom_age', $age->noma) ?>" /><br />
<?= validation_show_error('noma') ?>

<button type="submit" class="btn btn-primary">Mettre à jour</button>
<?= form_close() ?>
