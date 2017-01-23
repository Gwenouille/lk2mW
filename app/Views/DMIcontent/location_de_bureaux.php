<?php $this->layout('layout', ['title' => 'Location de bureaux',
'link1'=>'',
'link2'=>'',
'link3'=>'',
'link4'=>'',
'link5'=>'link5',
'displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('main_content') ?>

<main class="main">
  <h2 class="titre_service">
    <img src="<?= $this->assetUrl('logos/locationFond.png')?>" alt="logo de la location de bureaux">
    <span>Location de bureaux</span>
  </h2>
  <p>
    DMI c'est trois espaces locatifs de bureaux équipés sur 300 m².
  </p>
  <h3 class="italic">DES SERVICES COMMUNS</h3>
  <ul>
    <li>un espace détente avec distributeur de boissons</li>
    <li>un parking privatif de 45 places avec borne de recharge électrique</li>
    <li>un accès sécurisé 24h/24</li>
  </ul>
  <h3 class="italic">DES PLATEAUX DE BUREAUX</h3>
  <ul>
    <li>au premier niveau une salle de 177 m²</li>
    <li>au deuxième niveau une salle de 43 m²</li>
    <li>dans le bâtiment exterieur une salle de 80 m²</li>
  </ul>
  <h3 class="italic">LES TARIFS</h3>
  <p>
  au mètre carré: 81,61 € HT/HC/an et jusqu'à -30 % pour les entreprises innovantes
  </p>
</main>

<?php $this->stop('main_content') ?>
