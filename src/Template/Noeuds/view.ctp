<div class="row">
  	<h2><?= h($noeud->mot) ?></h2>
  	<ul class="vertical menu" data-accordion-menu>
	  <li>
	    <a href="#">Définition</a>
	    <ul class="menu vertical nested is-active">
	    	
		    <?php foreach ($def->definitions as $key): ?>
	  			<?php 
	  				echo "<div class=\"callout primary\"><li><p>".$key->def."</p></li></div>";
	  			?>
			<?php endforeach; ?>
	    </ul>
	  </li>
	  <?php
	  	if ($r_associated == "checked") {
	  	 	echo "<li><a href=\"#\">Idée(s) Associée</a></li>";
	  	 } 
	  ?>
	  
	</ul>
  	
  	<p><?= h($noeud->type) ?></p>
  	<p><?= h($noeud->poids) ?></p>
</div>
