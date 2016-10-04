</br>
<div class="row">
  <form>
    <div class=medium-6 colums">
	<label>
	    <input type="text" placeholder="Recherche">
	</label>
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