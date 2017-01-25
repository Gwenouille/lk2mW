<?php $this->layout('layout', ['title' => 'Fabrication additive',
'link1'=>'',
'link2'=>'link2',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<!-- Ajoute un css pour cette page seulement, pour le chat-->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/news_view.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>


<!-- Div contenants les news -->
<main class="main_news">

	<?php
	foreach ($newsList as $key=>$value) {
		if ($newsList[$key]['state']==='1'){
	?>
	  <div class="news_section">
	    <h2 class="news_tittle"><?=$newsList[$key]['title']?></h2>
	      <div class="news_content">
					<?php
						$pictures=$newsList[$key]['pictures'];
						foreach ($pictures as $key2=>$value2) {
							$url="images/";
							$url.=$newsList[$key]['id'];
							$url.="/";
							$url.=$pictures[$key2]['name'];
							$url.=".";
							$url.=$pictures[$key2]['type'];
					?>
					<div class="img_content">
						<img src="<?= $this->assetUrl($url); ?>" alt="">
					</div>
					<?php } ?>
					<p><?=$newsList[$key]['content']?>
					</p>
	      </div>
	  </div>

		<?php
		}
	}
	?>

</main>
<?php $this->stop('main_content') ?>
