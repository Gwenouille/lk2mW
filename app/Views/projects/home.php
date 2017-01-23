<?php $this->layout('layout', ['title' => 'Projects Home',
'link1'=>'',
'link2'=>'link2',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<!-- Ajoute un css pour cette page seulement, pour le chat-->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/chat.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

	<main class="main">

			<!--La section projects-->
		<div class="project">

			<!-- La section liste des projets -->
			<div class="listProject">
				<h3 class="blocTitleProject">Liste de mes projets :</h3>
				<div class="listProjectContent">
					<?php	foreach ($projectsList as $key => $value) :?>
						<h4><span class="glyphicon glyphicon-eye-open"></span>&nbsp;<?= $projectsList[$key]['name']?></h4>
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
				</div>
			</div>

			<!-- La section visualisation des projets -->
			<div class="previewProject">
				<h3 class="blocTitleProject">Description de mes projets :</h3>

				<form class="detailProject" action="" method="">

						<label for="titleProject" class="labelProject">
							Titre du projet :
						</label>
						<input class="formControl" type="text" name="titleProject" value="...">

						<label for="dateProject" class="labelProject">
							Date de début du projet :
						</label>
						<input class="formControl" type="text" name="dateProject" value="...">

						<label for="detailProject" class="labelProject">
							Description du projet :
						</label>
								<textarea class="formControl" rows="10"></textarea>

						<label for="fileProject" class="labelProject">
							Fichiers joints au projet :
						</label>
						<input class="formControl" type="text" name="fileProject" value="...">

					<div class="formButton">
					<button type="submit">Modifier</button>
					<button type="submit">Créer un nouveau projet</button>
					</div>
				</form>
			</div>
		</div>

		<!--La section messages-->
		<div class="chat">
			<p><h3 class="blocTitleProject">Mes messages :</h3></p>
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
				<input class ="chatMessage" type="text" name="newMessage" value="">
				<button type="submit">Envoyer</button>
			</form>
		</div>

	</main>

<?php $this->stop('main_content') ?>
