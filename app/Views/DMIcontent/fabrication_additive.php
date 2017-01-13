<?php $this->layout('layout', ['title' => 'Fabrication additive','displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('main_content') ?>

  <main class="main">
    <h2 class="titre_service">
      <img src="<?= $this->assetUrl('logos/fabricationFond.png')?>" alt="logo de l'espace fabrication additive">
      <span>Fabrication Additive</span>
    </h2>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img src="<?= $this->assetUrl('images/journaux1.jpg'); ?>" alt="First slide">
          <div class="carousel-caption">
            <h3>1ere news</h3>
            <p>Ceci est la premiere news</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?= $this->assetUrl('images/journaux2.jpg'); ?>" alt="Second slide">
          <div class="carousel-caption">
            <h3>2eme news</h3>
            <p>Ceci est la deuxieme news</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?= $this->assetUrl('images/journaux3.jpg'); ?>" alt="Third slide">
          <div class="carousel-caption">
            <h3>3eme news</h3>
            <p>Ceci est la troisieme news</p>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="icon-prev" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="icon-next" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="actu-fabrication">
      <p>DMI propose un accompagnement pour réaliser vos maquettes et vos prototypes.</p>
      <p>De la conception à la réalisation, des professeurs agrégés (du lycée Pablo Neruda de Dieppe), des ingénieurs d'écoles locales et des partenaires (CESI, INSA, ESIGELEC, l'entreprise Volum-e…) vous accompagnent dans l'apprentissage et la formation de vos collaborateurs.</p>
      <p>Un parc d'imprimantes 3D dernière génération permet d'obtenir un résultat de qualité et un  niveau de détails élevé avec des prototypes multimatériaux ou en couleurs.</p>
    </div>

    <div class="section-fabrication">
      <h3 class="section-fabrication-titre">Formation et Conception</h3>
      <div class="content-section">
        <img class="img-right" src="https://placekitten.com/g/200/300" alt="">
        <div class="description-section">
          <h5>DMI est équipé de :</h5>
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
      <h3 class="section-fabrication-titre">Design 3D</h3>
      <div class="content-section">
        <img class="img-left" src="https://placekitten.com/g/200/300" alt="">
        <div class="description-section">
          <h5>DMI est équipé pour un rendu visuel réaliste :</h5>
            <p>- D'un bras de sculpture</p>
            <p>- D'une tablette graphique</p>
            <p>- Imprimante 3D 660 pro
              <p class="imprimante-3d">1 million de couleurs en une seule impression</p> <p class="imprimante-3d">Volume de fabrication : 254 x 381 x 203 mm</p>
            </p>
        </div>
      </div>
    </div>

    <div class="section-fabrication">
      <h3 class="section-fabrication-titre">Impression 3D</h3>
      <div class="content-section">
        <img class="img-right" src="https://placekitten.com/g/200/300" alt="">
        <div class="description-section">
          <h5>DMI propose des imprimantes produisant des pieces de qualité :</h5>
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
