<?php $this->layout('layout', ['title' => 'Mon espace','displayConnectLink' =>$connectLinkChoice]); ?>

<?php $this->start('main_content'); ?>
<!--navigation   -->
<section>
<label>
  <input type="checkbox" id="cbox1" value="checkbox1">
  MON COMPTE
</label>
</p>
<p>
<label>
  <input type="checkbox" id="cbox2" value="checkbox2">
  MES PROJETS
</label>
</p>
</section>


<?php $this->stop('main_content') ?>
