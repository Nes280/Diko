</br>
</br>
<div class="row">
  <h3>Liste des mots les plus fréquents</h3>
  <table>
    <thead>
	<tr>
	    <th>Id</th>
	    <th>mot</th>
	    <th>type</th>
	    <th>poids</th>
	</tr>
    </thead>
    <tbody>
      <?php foreach ($noeuds as $noeud): ?>
      <tr>
	  <td><?= $noeud->id ?></td>
	  <td>
	      <?= $this->Html->link(html_entity_decode($noeud->mot), ['action' => 'view', $noeud->id]) ?>
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