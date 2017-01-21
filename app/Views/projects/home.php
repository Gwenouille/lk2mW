
<?php $this->layout('layout', ['title' => 'Projects Home','displayConnectLink' =>$connectLinkChoice]) ?>

<!-- Ajoute un css pour cette page seulement, pour corriger l'affichage de la nav -->
<?php $this->start('css') ?>
	<!--<link rel="stylesheet" href="<?= $this->assetUrl('css/header_footer_index.css') ?>">-->
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

	<main class="main">


		<!--La section projects-->
		<?php	foreach ($projectsList as $key => $value) :?>
			<h2><?= $projectsList[$key]['name']?></h2>
			<p><em><?= $projectsList[$key]['date']?></em></p>
			<p><?= $projectsList[$key]['description']?></p>
			<ul>
				<?php
					if (isset($projectsList[$key]['files']) && !empty ($projectsList[$key]['files'])) {
						$files=$projectsList[$key]['files'];

				 	foreach ($files as $key => $value) :?>
						<li>
							<?php echo($files[$key]['name'].".".$files[$key]['type']) ?>
						</li>
				 	<?php endforeach;
					} ?>
			</ul>
		<?php endforeach ?>

		<!--La section messages-->
		<ul>
		<?php	foreach ($messages as $key => $value) :?>
			<?php $class = ($messages[$key]['users_id']==='3') ? 'chat_user' : 'chat_admin';?>
			<li class=<?=$class?>>
				<p><?= $messages[$key]['content']?></p>
			</li>
		<?php endforeach ?>
		</ul>

	</main>

<?php $this->stop('main_content') ?>
