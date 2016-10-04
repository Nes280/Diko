</br>
<div class="row">
	<form>
		<div class="row">
			<div class="medium-6 columns">
			  <label>
				<input type="text" placeholder="Recherche">
			  </label>
			</div>
		</div>
	</form>
</div>
</br>
</br>
<div class="row">
	<h3>Liste des mots avec les poids les plus forts</h3>
	<table>
		<thead>
			<tr>
				<th>Id</th>
				<th>Mot</th>
				<th>Type</th>
				<th>Poids</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($noeuds as $noeud): ?>
			<tr>
				<td><?= $noeud->id ?></td>
				<td>
					<?= $this->Html->link($noeud->mot, ['action' => 'view', $noeud->id]) ?>
				</td>
				<td>
					<?= $noeud->type ?>
				</td>
				<td>
					<?= $noeud->poids ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>