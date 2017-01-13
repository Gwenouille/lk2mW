<?php $this->layout('layout', ['title' => 'Coworking','displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('main_content') ?>

<main class="main">
  <h2 class="titre_service">
    <img src="<?= $this->assetUrl('logos/coworkingFond.png')?>" alt="logo de l'espace coworking">
    <span>Coworking</span>
  </h2>
  <p>
    Premier espace de coworking du bassin dieppois, DMI répond aux besoins des indépendants, entrepreneurs, commerciaux, consultants, intermittents, salariés externalisés…
    Cet espace aménagé et équipé offre à moindre coût une souplesse et une efficacité de travail dans une ambiance stimulante de partage. Les utilisateurs bénéficient aussi des services du pôle création d'entreprises.
    Les formules de travail s'adaptent de la demi-journée à la période longue (plusieurs mois).
  </p>
</main>

<?php $this->stop('main_content') ?>
