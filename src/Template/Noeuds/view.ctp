<div class="row">
  	<h3><?= h($noeud->id) ?>   <?= h($noeud->mot) ?></h3>
  	<?php foreach ($def->definitions as $key): ?>
  		<?php 
  			echo $key->def; 
  			echo "</br>";
  		 ?>
	<?php endforeach; ?>
  	<p><?= h($noeud->type) ?></p>
  	<p><?= h($noeud->poids) ?></p>
</div>
