<div class="row">
  	<h2><?= h($noeud->mot) ?></h2>
	
	<ul class="vertical menu" data-accordion-menu>
	  <li>
		<a href="#">Polarité en %</a>
		<ul class="menu vertical nested is-active">
			<div class = "row">
				<div class="small-12 columns">
					<div class="small-2 columns">
						Négatif
					</div>
					<div class="small-10 columns">						
						<div class="alert progress">
							<div class="progress-meter" style="width: <?= $negatif ?>%"> <p class="progress-meter-text"><?= $negatif ?></p></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class = "row">
				<div class="small-12 columns">
					<div class="small-2 columns">
						Neutre
					</div>
					<div class="small-10 columns">						
						<div class="warning  progress">
							<div class="progress-meter" style="width: <?= $neutre ?>%"> <p class="progress-meter-text"><?= $neutre ?></p></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class = "row">
				<div class="small-12 columns">
					<div class="small-2 columns">
						Positif
					</div>
					<div class="small-10 columns">						
						<div class="success progress">
							<div class="progress-meter" style="width: <?= $positif ?>%"> <p class="progress-meter-text"><?= $positif ?></p></div>
						</div>
					</div>
				</div>
			</div>
		</ul>
	  </li>
	  
	</ul>
	
	
	
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
	  /*
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
	  */
	  	 foreach ($relations as $key => $value) {
	  	 	if ($value == 'checked') {
		  	 	echo "<li><a href=\"#\">$key</a>";
		  	 	echo "<ul class=\"menu vertical nested is-unactive\">";
		  	 	echo "<div class=\"row align-rigth\">";
		  	 	if ($key == 'r_associated') {
		  	 		foreach ($r_associated as $value) {
	  	 				echo "<div class=\"large-4 column\">";
	  	 				echo "<li><a href=\"/diko/noeuds/view/$value->id\">".$value->mot."</a></li>";
	  	 				echo "</div>";
	  	 			}
		  	 	}
		  	 	echo "</div>";
		  	 	echo "<div class=\"pagination text-center\" role=\"navigation\">".$this->Paginator->numbers()."</ul></li>";
		  	}
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
