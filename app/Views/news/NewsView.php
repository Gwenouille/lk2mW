<?php $this->layout('layout', ['title' => 'News','displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/NewsView.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

<main class="newsEditMain">
<section class="newsEditListArticle">
	<form>
  		<input type="submit" value="Créer">
  		<div class="newsEditListing">
  			<?php if(!empty($articleList)): ?>
  				<ul>
	  				<?php foreach ($articleList as $key => $value) :?>
  						<li>
  							<!-- div de la checkbox -->
  							<div class="newsListCheckbox">
  								<input type="checkbox" name="check_<?php echo $key ?>" checked>
  							</div>
  							<!-- div de la description de l'article -->
  							<div class="newsListContent">
  								<h2><?php echo($articleList[$key]['title']); ?></h2>
  								<p>Créé le <?php echo($articleList[$key]['date_creation']); ?> - Modifié le <?php echo($articleList[$key]['date_modification']); ?></p>
  								<p><?php echo($articleList[$key]['content']); ?></p>
  							</div>
  							<!-- div des boutons d'action -->
  							<div class="newsListAction">
  								<p><input type="submit" name="check_<?php echo $key ?>" value="Modifier"></p>
  								<p><input type="submit" name="check_<?php echo $key ?>" value="effacer"></p>
  								<input type="hidden" value="<?php echo $articleList[$key]['id'] ?>">
  							</div>
  						</li>
  					<?php endforeach ?>
  				</ul>
  			<?php else : ?>
  				<p>Vide</p>
  			<?php endif ?>

  		</div>
	</form>
</section>
<section class="newsEditShowArticle">
	<h2>Création d'un article</h2>
	<div class="news">
		<div class="news_error"></div>
		<form enctype="multipart/form-data" id="news_form" name="news_form" method="post" class="form_news">
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
			<input type="submit" name="news_submit" value="Valider">
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