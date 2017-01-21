
<?php $this->layout('layout', ['title' => 'Projects Home','displayConnectLink' =>$connectLinkChoice]) ?>

<!-- Ajoute un css pour cette page seulement, pour le chat-->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/chat.css') ?>">
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
		<div class="chat">
			<ul class="chat_content">
			<?php	foreach ($messages as $key => $value) :?>
				<?php $class = ($messages[$key]['users_id']==='3') ? 'chat_users' : 'chat_admin';?>
				<li>
					<div class="chat_message <?=$class?>">
						<p><?= $messages[$key]['content']?></p>

						<p class="chat_date"><?= $messages[$key]['date']?></p>
					</div>
				</li>
			<?php endforeach ?>
			</ul>
			<form class="chat_input" action="<?= $this->url("projects_sendmsg"); ?>" method="post">
				<input type="text" name="newMessage" value="">
				<button type="submit">Envoyer</button>
			</form>
		</div>

	</main>

<?php $this->stop('main_content') ?>
