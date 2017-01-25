<?php $this->layout('layout', ['title' => 'News',
'link1'=>'',
'link2'=>'link2',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/admin_news_view.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

<!--navigation  choix de l'user-->
<div class="userChoice">
	<a class="userChoice_icons" href="<?= $this->url("user_home"); ?>"><span class="glyphicon glyphicon-user"></span>MON&nbsp;COMPTE</a>&nbsp;&nbsp;
	<a class="userChoice_icons" href="<?= $this->url("projects_home"); ?>"><span class="glyphicon glyphicon-list-alt"></span>UTILISATEURS</a>&nbsp;&nbsp;
	<a class="userChoice_icons" href="<?= $this->url("news_edit"); ?>"><span class="glyphicon glyphicon-globe"></span>NEWS</a>
</div>

<main class="main">

	<!--La section news-->
	<div class="newsSection">

		<!-- La section listes des news -->
		<div class="newsEditListArticle">
			<h3 class="titleList">Liste des articles :</h3>
			<div class="listNews">
				<div class="listNewsContent">
				<?php if(!empty($articleList)): ?>
					<ul id="list">
	  				<?php foreach ($articleList as $key => $value) :?>
							<li>
	              <form action="<?= $this->url("news_edit"); ?>" method="post" class="form_listArticle">
									<!-- div de la checkbox -->
									<div class="newsListCheckbox">
	                	<?php $bCheck ="";
	                 	if($articleList[$key]['state']==!0) $bCheck = "checked"; ?>
										En ligne : <input id="checkbox<?=$articleList[$key]['id']?>" class="newsCheckbox" type="checkbox" name="check" <?= $bCheck ?>>
									</div>
									<!-- div de la description de l'article -->
									<div class="newsListContent">
										<h2><?= $articleList[$key]['title'] ?></h2>
										<p>Créé le <?= $articleList[$key]['date_creation'] ?> - Modifié le <?= $articleList[$key]['date_modification'] ?></p>
										<p><?= $articleList[$key]['content'] ?></p>
									</div>
									<!-- div des boutons d'action -->
									<div class="newsListAction">
										<p><input type="submit" name="modifyNews" value="Modifier"></p>
										<input type="hidden" value="<?= $articleList[$key]['id'] ?>" name="articleId">
									</div>
	            	</form>
							</li>
						<?php endforeach ?>
					</ul>
				<?php else : ?>
					<p>Vide</p>
				<?php endif ?>
				</div>
			</div>

		</div>

		<!-- La section visualisation/édition des news -->
		<div class="newsEditShowArticle">
			<h3 class="titleList">Création d'un article :</h3>

			<input type="button" value="Créer un nouvel article" name="news_creation" id="creationButton">

			<div class="news">
				<div class="news_error"></div>
				<form enctype="multipart/form-data" id="news_form" name="news_form" method="post" class="form_news" action="<?= $this->url("news_newsAjaxModify"); ?>">
					<div class="news_title">
						<label for="news_article_title">Titre de l'article</label>
						<div class="news_error"></div>
						<input type="text" id="news_article_title" name="article_title" placeholder="Mon titre">
					</div>
					<div class="news_file">
						<label for="news_files_title">Illustrations</label>
						<div class="news_error"></div>
						<input type='file' name='news_files_input[]' multiple>
					</div>
					<div class="news_file_preview"></div>
					<div class="news_content">
						<label for="news_content_title">Contenu</label>
						<div class="news_error"></div>
						<textarea id="news_content_title" name="news_content" placeholder="Mon contenu"></textarea>
					</div>
		      <div class="news_input_button">
						<input type="submit" name="news_submit" value="Créer">
					</div>
				</form>
			</div>

		</div><!-- fin de la classe visualisation des news -->

	</div>
</main>

<?php $this->stop('main_content') ?>

<!-- Ajoute un javascript pour cette page seulement -->
<?php $this->start('js') ?>
  	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea',plugins: "link" });</script>
		<script type="text/javascript" src="<?= $this->assetUrl('javascript/news.js') ?>"></script>
<?php $this->stop('js') ?>
