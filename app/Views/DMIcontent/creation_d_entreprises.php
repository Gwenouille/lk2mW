<?php $this->layout('layout', ['title' => 'Création d\'entreprise',
'link1'=>'link1',
'link2'=>'',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('main_content') ?>

<main class="main">
  <h2 class="titre_service">
    <img src="<?= $this->assetUrl('logos/creationFond.png')?>" alt="logo de la creation d'entreprise">
    <span>Création d'entreprises</span>
  </h2>
  <p>
    À la fois couveuse et pépinière d'entreprises, DMI accueille les entrepreneurs, qu'ils soient créateurs, porteurs de projet ou chefs d'entreprise, pendant leurs premières années d'activités.
    Cette organisation propose un hébergement, un accompagnement et un accès mutualisé qui permet à l'entrepreneur de se concentrer sur son projet d'entreprise dans un environnement de qualité.
  </p>
</main>

<?php $this->stop('main_content') ?>
