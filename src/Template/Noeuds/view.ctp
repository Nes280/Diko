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
	  	if ($r_associated != "") {
	  	 	echo "<li><a href=\"#\">Idée(s) Associée</a>";
	  	 	echo "<ul class=\"menu vertical nested is-active\">";
	  	 	foreach ($data as $value) {
	  	 		echo "<li><a href=\"/diko/noeuds/view/$value->id\">".$value->mot."</a></li>";
	  	 	}
	  	 	
	  	 	echo "</ul></li>";

	  	 } 
	  ?>
	  
	</ul>
</div>
