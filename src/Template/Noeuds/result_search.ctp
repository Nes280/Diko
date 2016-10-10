</br>
</br>
<div class="row">
	<h3>Resultat</h3>
		<div class="row align-rigth">
		<?php foreach ($noeuds as $noeud): ?>
			<div class="large-4 column">
				<?= $this->Html->link(html_entity_decode($noeud->mot), ['action' => 'view', $noeud->id]) ?>
			</div>
		<?php endforeach; ?>	
	</div>
		<?php 
		//echo $this->Paginator->numbers();
		echo "<ul class='pagination text-center' role='navigation' aria-label='Pagination'>";
		echo $this->Paginator->numbers(['modulus' => 6, 'last' => 3]);
		echo "</ul>";
?>


	

</div>