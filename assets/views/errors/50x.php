<?php if ($isProduction): ?>
  <h1>Server Internal Error</h1>
<?php else: ?>
  <h1><?=$error->getMessage();?></h1>
  <p>In Line: <?=$error->getLine();?></p>
  <p>In File: <?=$error->getFile();?></p>
  <pre>
    <?php print_r($error->getTrace());?>
  </pre>
<?php endif; ?>