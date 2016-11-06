<div class="row">
  	<h2><?= h($noeud->mot) ?></h2>
	<h3>Polarité</h3>
	<?= $negatif->poids ?>
	<?= $neutre->poids ?>
	<?= $positif->poids ?>

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
	  	 	echo "<div class=\"row align-rigth\">";
	  	 	foreach ($data as $value) {
	  	 		echo "<div class=\"large-4 column\">";
	  	 		echo "<li><a href=\"/diko/noeuds/view/$value->id\">".$value->mot."</a></li>";
	  	 		echo "</div>";
	  	 		
	  	 	}
	  	 	echo "</div>";
	  	 	echo "<div class=\"pagination text-center\" role=\"navigation\">".$this->Paginator->numbers()."</div></ul></li>";
	  	 } 
	  ?>
	  
	</ul>
</div>


<!--script type="text/javascript">
$(function() {
    $('#pagination').pagination({
        items: 100,
        itemsOnPage: 10,
        cssStyle: 'light-theme',
        hrefTextPrefix: "?page="
    });
});
$('#pagination').pagination('drawPage', 5);
</script!-->
