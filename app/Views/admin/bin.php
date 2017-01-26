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
