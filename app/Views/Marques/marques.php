<?php $current_page = 'marques'; ?>
<?= view('Partials/nav', ['current_page' => $current_page]) ?>

<?= $this->extend('layout-compte') ?>

<?= $this->section('content') ?>

<section class="marques-header">
    <h1>Nos Marques Partenaires</h1>
</section>


<section class="brands">
    <?php if (!empty($marques)): ?>
        <?php foreach ($marques as $marque): ?>
            <div class="brand">
             
                <a href="<?= base_url('marques/' . $marque['id_marque']) ?>">
                  
                    <img src="<?= base_url(esc($marque['logo'])) ?>" alt="<?= esc($marque['nomm']) ?>" class="brand-logo">
                   
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune marque enregistrée.</p>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>
