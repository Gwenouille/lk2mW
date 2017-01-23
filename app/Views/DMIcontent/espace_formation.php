<?php $this->layout('layout', ['title' => 'Espace formation',
'link1'=>'',
'link2'=>'',
'link3'=>'link3',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('main_content') ?>

<main class="main">
  <h2 class="titre_service">
    <img src="<?= $this->assetUrl('logos/formationFond.png')?>" alt="logo de l'espace formation">
    <span>Espace formation</span>
  </h2>
  <p>
    DMI met à votre disposition deux espaces de formation fonctionnels et agréables sur 345&nbsp;m².
  </p>
  <h3 class="italic">DES SERVICES COMMUNS</h3>
  <ul>
    <li>un espace détente avec distributeur de boissons</li>
    <li>un parking privatif de 45 places avec borne de recharge électrique</li>
    <li>un accès sécurisé 24h/24</li>
  </ul>
  <h3 class="italic">DES PLATEAUX DE BUREAUX</h3>
  <ul>
    <li>Une salle de 45 m² et une de 300&nbsp;m²</li>
  </ul>
  <h3 class="italic">LES TARIFS</h3>
  <table class="table_tarifs">
    <thead>
      <tr>
        <th></th>
        <th class="middle_blue">½ journée</th>
        <th class="middle_blue">Journée</th>
        <th class="middle_blue">Soirée (18h/22h)</th>
        <th class="middle_blue">Forfait semaine</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th class="light_blue">Petite salle (2ème niveau)</th>
        <td>70€ HT</td>
        <td>100€ HT</td>
        <td>Sans objet</td>
        <td>400€ HT</td>
      </tr>
      <tr>
        <th class="light_blue">Grande salle (RDC)</th>
        <td>140€ HT</td>
        <td>850€ HT</td>
        <td>300€ HT</td>
        <td>600€ HT</td>
      </tr>
    </tbody>
  </table>
</main>

<?php $this->stop('main_content') ?>
