<div class="row">
  	<h2><?= h($noeud->mot) ?></h2>
	
	<ul class="vertical menu" data-accordion-menu>
	  <li>
		<a href="#"><span class=\"Warning label\">Polarité en %</span></a>
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
	    <a href="#"><li><a href=\"#\"><span class=\"Warning label\">Définition</span></a></a>
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
	  	 /*foreach ($relations as $key => $value) {
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
	  	 }*/
		 foreach ($relationMots as $key => $value) {
			if($session !== 'session'){
				if ($key[0] == "r" && $key[1] == "_") {
				 	echo "<li><a href=\"#\"><span class=\"secondary label\">$key</span></a>";
				 } 
				else if (strpos($key, ">"))
					{
						echo "<li><a href=\"#\"><span class=\"alert label\">$key</span></a>";
					}
				else echo "<li><a href=\"#\"><span class=\"success label\">$key</span></a>";
				echo "<ul class=\"menu vertical nested is-unactive\">";
				echo "<div class=\"row align-rigth\" id=\"$key\">";
				echo "<div class=\"list\">";
				$compteur = 0;
				foreach($value as $mot){
					echo "<div class=\"large-4 column\" class=\"list\">";
					echo "<li><a href=\"/diko/noeuds/view/$mot[1]\">".$mot[0]."</a></li>";
					//echo "<li><a href=\"/diko/noeuds/view/$mot\">".$mot."</a></li>";
	  	 			echo "</div>";
	  	 			$compteur++;
				}
				echo "</div><ul class=\"pagination\"></ul></div></ul></li>";
				if ($compteur>10)
				{echo "<script>
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
</script>";}
				
			}
			else if(($s = $this->request->session()->read('User.' . $key)) === 'checked' ){
				echo "<li><a href=\"#\">$key</a>";
				echo "<ul class=\"menu vertical nested is-unactive\">";
				echo "<div class=\"row align-rigth\">";
				$compteur = 0;
				foreach($value as $mot){
					echo "<div class=\"large-4 column\">";
					echo "<li><a href=\"/diko/noeuds/view/$mot[1]\">".$mot[0]."</a></li>";
	  	 			echo "</div>";
	  	 			$compteur++;
				}
				echo "</ul></li>";
				if ($compteur>10)
				{echo "<script>
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
</script>";}
			}
	  	 }
		 
	  ?>
	  
	</ul>
</div>
</br>
</br>
</br>
</br>


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
