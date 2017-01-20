
<?php $this->layout('layout', ['title' => 'Projects Home','displayConnectLink' =>$connectLinkChoice]) ?>

<!-- Ajoute un css pour cette page seulement, pour corriger l'affichage de la nav -->
<?php $this->start('css') ?>
	<!--<link rel="stylesheet" href="<?= $this->assetUrl('css/header_footer_index.css') ?>">-->
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

	<main class="main">
	<?php echo($html);
	var_dump($projectsList);

	?>
	</main>

<?php $this->stop('main_content') ?>
