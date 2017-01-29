<?php $this->layout('layout', ['title' => 'Projects Home',
'link1'=>'',
'link2'=>'link2',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<!-- Ajoute un css pour cette page seulement, pour le chat-->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/user_projects.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/chat.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

	<div class="userChoice">
		<a href="<?= $this->url("user_home"); ?>"><span class="glyphicon glyphicon-user"></span>MON COMPTE</a>&nbsp;&nbsp;
		<a href="<?= $this->url("projects_home"); ?>"><span class="glyphicon glyphicon-list-alt"></span>MES PROJETS</a>
	</div>

	<main class="main">

		<!--La section messages-->
		<div class="chat">
			<p><h3 class="blocTitleProject">Mes messages :</h3></p>
			<ul id="chat_content" class="chat_content">
				<?php	foreach ($messages as $key => $value) :?>
					<?php $class = ($messages[$key]['users_id']!=='3') ? 'chat_users' : 'chat_admin';?>
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

		<!--La section projects-->
		<div class="projectSection">

			<!-- La section liste des projets -->
			<div class="listProject">
				<h3 class="blocTitleProject">Liste de mes projets :</h3>
				<div class="listProjectContent">
					<?php	foreach ($projectsList as $key => $value) :?>
						<div class="project">
							<h4><span id="projectID<?= $projectsList[$key]['id']  ?>" class="glyphicon glyphicon-eye-open"></span>&nbsp;<?= $projectsList[$key]['name']?></h4>
							<p><em><?= $projectsList[$key]['date']?></em></p>
							<p><?= $projectsList[$key]['description']?></p>
							<ul>
								<?php
								if (isset($projectsList[$key]['files']) && !empty ($projectsList[$key]['files'])) {
									$files=$projectsList[$key]['files'];
									foreach ($files as $key => $value) :?>
										<li id=lifileID<?= $files[$key]['id'] ?>>
								 			<?php
								 			$dir = $this->url($w_current_route);
											$cherche = "public/fabrication_additive/projects/";
											$remplace = "private/projects/".$files[$key]['projects_id']."/";
											$projectTargetDir = str_replace($cherche,$remplace,$dir);
								 			?>
											<a href="<?= $projectTargetDir.$files[$key]['name'].'.'.$files[$key]['type'] ?>" download="<?php echo($files[$key]['real_name'].".".$files[$key]['type']) ?>">
												<?php echo($files[$key]['real_name'].".".$files[$key]['type']) ?>
											</a>
											<span id="fileID<?= $files[$key]['id'] ?>" class="glyphicon glyphicon-trash">
										</li>
								 	<?php endforeach;
								} ?>
							</ul>
						</div>
					<?php endforeach ?>
				</div>
			</div>

			<!-- La section visualisation des projets -->
			<div class="previewProject">
				<h3 class="blocTitleProject">Description de mes projets :</h3>

				<form class="detailProject" action="" method="post" id="projectForm">

						<label for="titleProject" class="labelProject">
							Titre du projet :
						</label>
						<input class="formControl" type="text" name="titleProject" value="...">

						<label for="detailProject" class="labelProject">
							Description du projet :
						</label>
						<textarea class="formControl" rows="10" name="contentProject" id="contentProject"></textarea>

						<label for="fileProject" class="labelProject">
							Fichiers joints au projet :
						</label>
						<input class="formControl" type="file" name="fileProject[]" multiple>
						<input type="hidden" name="idProject" id="idProject">
					<div class="formButton">
					<button type="submit" id="modifyProject">Modifier</button>
					<button type="submit" id="createProject">Créer un nouveau projet</button>
					</div>
				</form>
			</div>

		</div><!--Fin de la section projets-->

	</main>

<?php $this->stop('main_content') ?>
<?php $this->start('js') ?>
		<script type="text/javascript" src="<?= $this->assetUrl('javascript/chat.js') ?>"></script>
		<script type="text/javascript" src="<?= $this->assetUrl('javascript/projects.js') ?>"></script>
<?php $this->stop('js') ?>
