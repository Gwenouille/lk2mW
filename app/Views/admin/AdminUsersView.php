<?php $this->layout('layout', ['title' => 'News',
'link1'=>'',
'link2'=>'link2',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/admin_users_view.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/chat.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

<!--navigation  choix de l'user-->
<div class="userChoice">
	<a class="userChoice_icons" href="<?= $this->url("user_home"); ?>"><span class="glyphicon glyphicon-user"></span>MON&nbsp;COMPTE</a>&nbsp;&nbsp;
	<a class="userChoice_icons" href="<?= $this->url("projects_home"); ?>"><span class="glyphicon glyphicon-list-alt"></span>UTILISATEURS</a>&nbsp;&nbsp;
	<a class="userChoice_icons" href="<?= $this->url("news_edit"); ?>"><span class="glyphicon glyphicon-globe"></span>NEWS</a>
</div>


<main class="main">

	<!--La section messages-->
	<?php $messages=[];?>
	<div class="chat">
		<p><h3 class="blocTitleProject">Mes messages :</h3></p>
		<ul id= "chat_content" class="chat_content">
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
			<input id="chat_input" class ="chatMessage" type="text" name="newMessage" value="">
			<button type="submit">Envoyer</button>
		</form>
	</div>

	<!--La section users-->
	<div class="usersSection">

		<!-- La section liste des utilisateurs -->
		<div id="listUsers" class="listUsers">
			<h3 class="blocTitleProject">Liste des utilisateurs actifs :</h3>
			<ul class="listUsersContent">
				<?php	foreach ($usersList as $key => $value) :?>
					<li class="user">
						<h4><a class="userGlyphicon" id="userID<?=$usersList[$key]['id']?>" href=""><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;<?= $usersList[$key]['firstname'].' '.$usersList[$key]['lastname']?></h4>
					</li>
				<?php endforeach ?>
			</ul>
		</div>

		<!-- La section infos de l' utilisateur -->
		<div class="infosUser">
			<h3 class="blocTitleProject">Infos utilisateur :</h3>
			<div id="userCoordinates" class="coordinates">

				<p class="center">Selectionnez un utilisateur</p>

			</div>
		</div>

		<div class="listProject">
			<h3 class="blocTitleProject">Ses projets :</h3>
			<div id="listProjectContent" class="listProjectContent">

				<p class="center">Selectionnez un utilisateur</p>

			</div>
		</div>

	</div>
</main>

<?php $this->stop('main_content') ?>

<!-- Ajoute un javascript pour cette page seulement -->
<?php $this->start('js') ?>
  	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea',plugins: "link" });</script>
		<script type="text/javascript" src="<?= $this->assetUrl('javascript/chat.js') ?>"></script>
		<script type="text/javascript" src="<?= $this->assetUrl('javascript/users.js') ?>"></script>

<?php $this->stop('js') ?>
