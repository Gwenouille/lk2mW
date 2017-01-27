<ul>
  <?php
    if (isset($projectsList[$key]['files']) && !empty ($projectsList[$key]['files'])) {
      $files=$projectsList[$key]['files'];

      <p><em><?= $projectsList[$key]['date']?></em></p>
      <p><?= $projectsList[$key]['description']?></p>
    foreach ($files as $key => $value) :?>
      <li>
        <?php echo($files[$key]['name'].".".$files[$key]['type']) ?>
      </li>
    <?php endforeach;
    } ?>
</ul>

<?php	foreach ($projectsList as $key => $value) :?>
  <div class="project">
    <h4><?= $projectsList[$key]['name']?></h4>
    <p><em><?= $projectsList[$key]['date']?></em></p>
    <p><?= $projectsList[$key]['description']?></p>
    <ul>
      <?php
        if (isset($projectsList[$key]['files']) && !empty ($projectsList[$key]['files'])) {
          $files=$projectsList[$key]['files'];

        foreach ($files as $key2 => $value) :?>
          <li>
            <?php echo($files[$key2]['name'].".".$files[$key2]['type']) ?>
          </li>
        <?php endforeach;
        } ?>
    </ul>
  </div>
<?php endforeach ?>
