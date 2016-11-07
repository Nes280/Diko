</br>
</br>
<div class="row">
	<div class="callout secondary large">
		<div class="row">
			<h3>Liste des mots les plus fréquents</h3>
			<div class="row align-rigth">
				<?php foreach ($noeuds as $noeud): ?>
					<div class="large-4 column">
						<?= $this->Html->link(html_entity_decode($noeud->mot), ['action' => 'view', $noeud->id]) ?>
					</div>
				<?php endforeach; ?>		
			</div>
		</div>
	</div>
	</br>
	</br>
</div>