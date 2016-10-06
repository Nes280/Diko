</br>
</br>
<div class="row">
  <h3>Liste des mots les plus fréquents</h3>

      <?php foreach ($noeuds as $noeud): ?>
		<div class="row align-middle">
			  <?= $this->Html->link(html_entity_decode($noeud->mot), ['action' => 'view', $noeud->id]) ?>
		</div>
      <?php endforeach; ?>

</div>