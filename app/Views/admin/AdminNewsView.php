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
<main class="newsEditMain">
<section class="newsEditListArticle">
      <span class="confirmMsg"></span>
  		<input type="button" value="Créer" name="news_creation" id="creationButton">
  		<div class="newsEditListing">
  			<?php if(!empty($articleList)): ?>
  				<ul id="list">
	  				<?php foreach ($articleList as $key => $value) :?>
  						<li>
                <form action="<?= $this->url("news_edit"); ?>" method="post" class="form_listArticle">
  								<!-- div de la checkbox -->
  								<div class="newsListCheckbox">
                  	<?php $bCheck ="";
                   	if($articleList[$key]['state']==!0) $bCheck = "checked"; ?>
  									<input type="checkbox" name="check" <?= $bCheck ?>>
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
</section>
<section class="newsEditShowArticle">
	<h2>Création d'un article</h2>
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
			</div>
			<div class="news_file_preview"></div>
			<div class="news_content">
				<label for="news_content_title">Contenu</label>
				<div class="news_error"></div>
				<textarea id="news_content_title" name="news_content" placeholder="Mon contenu"></textarea>
			</div>
      <div class="news_input_button"></div>
		</form>
	</div>
</section>
</main>

<?php $this->stop('main_content') ?>

<!-- Ajoute un javascript pour cette page seulement -->
<?php $this->start('js') ?>
  		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  		<script>tinymce.init({ selector:'textarea',plugins: "link" });</script>
		<script type="text/javascript" src="<?= $this->assetUrl('javascript/news.js') ?>"></script>
<?php $this->stop('js') ?>
