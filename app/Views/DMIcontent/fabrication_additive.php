<?php $this->layout('layout', ['title' => 'Fabrication additive',
'link1'=>'',
'link2'=>'link2',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('main_content') ?>

  <main class="main">
    <h2 class="titre_service">
      <img src="<?= $this->assetUrl('logos/fabricationFond.png')?>" alt="logo de l'espace fabrication additive">
      <span>Fabrication Additive</span>
    </h2>
<!-- debut du carousel -->
    <a href="<?= $this->url("news_home"); ?>">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
      <?php	foreach ($newsList as $key=>$value) {
    		if ($newsList[$key]['state']==='1'){?>

        <li data-target="#carousel-example-generic" data-slide-to="<?=$key?>" <?php if($key==0){echo("class=active");}?>></li>

    		<?php
    		}
    	}?>
      </ol>

      <div class="carousel-inner" role="listbox">
      <?php foreach ($newsList as $key=>$value) {
        if ($newsList[$key]['state']==='1'){?>

        <div class="item <?php if($key==0){echo('active');}?>">
          <?php
          // S'il n'y a pas d'image dans cette news, on renvoie l'image noire.
          if (empty($newsList[$key]['pictures'])){
            $url="images/news/empty.jpg";
          } else {
          $url="images/";
          $url.=$newsList[$key]['id'];
          $url.="/";
          $url.=$newsList[$key]['pictures'][0]['name'];
          $url.=".";
          $url.=$newsList[$key]['pictures'][0]['type'];
          }
          ?>
          <img src="<?= $this->assetUrl($url); ?>" alt="First slide">
          <div class="carousel-caption">
            <h3><?=$newsList[$key]['title']?></h3>
          </div>
        </div>

        <?php
        }
      }?>
      </div>

      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </a>
<!--  fin du carousel-->

    <div class="actu-fabrication">
      <h4>
        <p>DMI propose un accompagnement pour réaliser vos maquettes et vos prototypes.</p>
        <p>De la conception à la réalisation, des professeurs agrégés (du lycée Pablo Neruda de Dieppe), des ingénieurs d'écoles locales et des partenaires (CESI, INSA, ESIGELEC, l'entreprise Volum-e…) vous accompagnent dans l'apprentissage et la formation de vos collaborateurs.</p>
        <p>Un parc d'imprimantes 3D dernière génération permet d'obtenir un résultat de qualité et un  niveau de détails élevé avec des prototypes multimatériaux ou en couleurs.</p>
      </h4>
    </div>

    <div class="section-fabrication">
      <h2 class="section-fabrication-titre">Formation et Conception</h2>
      <div class="content-section">
        <img class="img-right" src="../public/assets/images/FormConcept.jpg" alt="">
        <div class="description-section">
          <h3>DMI est équipé de :</h3>
            <p>- 8 postes de sculpture</p>
            <p>- Logiciels de CAO<span class ="asterix">*</span>, de simulation comportementale, d'optimisation topologique</p>
            <p>- Scanners 3D</p>

            <p class="asterix-description">
            * Conception Assistée par Ordinateur
            </p>
        </div>
      </div>
    </div>

    <div class="section-fabrication">
      <h2 class="section-fabrication-titre">Design 3D</h2>
      <div class="content-section">
        <img class="img-left" src="../public/assets/images/desing3d.jpg" alt="">
        <div class="description-section">
          <h3>DMI est équipé pour un rendu visuel réaliste :</h3>
            <p>- D'un bras de sculpture</p>
            <p>- D'une tablette graphique</p>
            <p>- Imprimante 3D 660 pro
              <p class="imprimante-3d">1 million de couleurs en une seule impression</p> <p class="imprimante-3d">Volume de fabrication : 254 x 381 x 203 mm</p>
            </p>
        </div>
      </div>
    </div>

    <div class="section-fabrication">
      <h2 class="section-fabrication-titre">Impression 3D</h2>
      <div class="content-section">
        <img class="img-right" src="../public/assets/images/3dPrinting.jpg" alt="">
        <div class="description-section">
          <h3>DMI propose des imprimantes produisant des pieces de qualité :</h3>
            <p>- Imprimante 3D Projet 5500x</p>
            <p class="imprimante-3d">Multimateriaux</p> <p class="imprimante-3d">Volume de fabrication : 550 x 393 x 300 mm</p>

            <p>- Imprimante MarkForged</p>
            <p class="imprimante-3d">Multimateriaux</p> <p class="imprimante-3d">Volume de fabrication : 320 x 132 x 154 mm</p>
          </p>
        </div>
      </div>
    </div>

  </main>

<?php $this->stop('main_content') ?>
