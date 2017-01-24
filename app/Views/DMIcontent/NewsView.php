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
  <br>
  <div class="news_section">
    <h2 class="news_tittle">News Tittle</h2>
      <div class="news_content">
        <img src="<?= $this->assetUrl('images/news1/1.jpg')?>" alt="">
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
  </div>

  <div class="news_section">
    <h2 class="news_tittle">News Tittle</h2>
      <div class="news_content">
        <img src="<?= $this->assetUrl('images/news1/1.jpg')?>" alt="">
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>

  <div class="news_section">
    <h2 class="news_tittle">News Tittle</h2>
      <div class="news_content">
        <img src="<?= $this->assetUrl('images/news1/1.jpg')?>" alt="">
          <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
  </div>
</main>
<?php $this->stop('main_content') ?>
