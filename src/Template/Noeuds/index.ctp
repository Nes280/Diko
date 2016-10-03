
<h1>Liste des mots avec les poids les plus forts</h1>
<table>
    <tr>
        <th>Id</th>
        <th>mot</th>
        <th>type</th>
		<th>poids</th>
    </tr>

    <!-- Ici se trouve l'itération sur l'objet query de nos $articles, l'affichage des infos des articles -->

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
</table>