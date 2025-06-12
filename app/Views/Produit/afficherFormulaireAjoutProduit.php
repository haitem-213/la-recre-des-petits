<?= $this->extend('layout') ?>

<?= $this->section('customtitle') ?>
Ajouter un Produit
<?= $this->endSection() ?>

<?= $this->section('custombody') ?>

<div class="container">
    <h2>Ajouter un Produit</h2>
    <?= \Config\Services::validation()->listErrors() ?>

    <form action="<?= base_url('afficherFormulaireAjoutProduit') ?>" method="post">
        <div class="form-group">
            <label for="nomp">Nom:</label>
            <input type="text" class="form-control" id="nomp" name="nomp" value="<?= set_value('nomp') ?>">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"><?= set_value('description') ?></textarea>
        </div>
        <div class="form-group">
            <label for="prix">Prix:</label>
            <input type="text" class="form-control" id="prix" name="prix" value="<?= set_value('prix') ?>">
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="text" class="form-control" id="stock" name="stock" value="<?= set_value('stock') ?>">
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="text" class="form-control" id="image" name="image" value="<?= set_value('image') ?>">
        </div>
        <div class="form-group">
            <label for="categorie_id">Catégorie ID:</label>
            <input type="text" class="form-control" id="categorie_id" name="categorie_id" value="<?= set_value('categorie_id') ?>">
        </div>
        <div class="form-group">
            <label for="age_id">Âge ID:</label>
            <input type="text" class="form-control" id="age_id" name="age_id" value="<?= set_value('age_id') ?>">
        </div>
        <div class="form-group">
            <label for="marque_id">Marque ID:</label>
            <input type="text" class="form-control" id="marque_id" name="marque_id" value="<?= set_value('marque_id') ?>">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?= $this->endSection() ?>
