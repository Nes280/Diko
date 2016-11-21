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
	  	 			echo "</div><div class=\"pagination text-center\" role=\"navigation\">".$this->Paginator->numbers()."</div>";
		  	 	}
		  	 	echo "</ul></li>";
		  	}
	  	 }
		 foreach ($relationMots as $key => $value) {
			if($session !== 'session'){ 
				echo "<li><a href=\"#\">$key</a>";
				echo "<ul class=\"menu vertical nested is-unactive\">";
				echo "<div class=\"row align-rigth\" id=\"$key\">";
				echo "<div class=\"list\">";
				foreach($value as $mot){
					echo "<div class=\"large-4 column\" class=\"list\">";
					echo "<li><a href=\"/diko/noeuds/view/$mot[0]\">".$mot[1]."</a></li>";
					//echo "<li><a href=\"/diko/noeuds/view/$mot[0]\">".$mot[1]."</a></li>";
	  	 			echo "</div>";
				}
				echo "</div><ul class=\"pagination\"></ul></div></ul></li>";
				echo "<script>
 var outerWindow = {
    name: \"outerWindow\",
    paginationClass: \"pagination\",
    outerWindow: 2
  };
  var options = {
    valueNames: [ 'name', 'category' ],
    page: 10,
    plugins: [
      ListPagination(outerWindow)

    ]
  };
  var listObj = new List('$key', options);
</script>";
			}
			else if(($s = $this->request->session()->read('User.' . $key)) === 'checked' ){
				echo "<li><a href=\"#\">$key</a>";
				echo "<ul class=\"menu vertical nested is-unactive\">";
				echo "<div class=\"row align-rigth\">";
				foreach($value as $mot){
					echo "<div class=\"large-4 column\">";
					echo "<li><a href=\"/diko/noeuds/view/$mot[0]\">".$mot[1]."</a></li>";
	  	 			echo "</div>";
				}
				echo "</ul></li>";
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
