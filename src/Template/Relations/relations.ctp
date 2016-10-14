</br>
</br>
<div class="row">
	<?php echo $this->Form->create('Relations');?>
	<fieldset class="fieldset">
		<legend>Choix des relations à afficher </legend>
			<?php foreach ($relations as $relation): ?>
				<B> 
					<?php echo $this->Form->input("$relation->noml", ['type' => 'checkbox', 'id' => "$relation->id", 'value' => "$relation->nomc", 'checked' => $c[$relation->nomc]]);?>
				</B>
				<p class="help-text" id="<?= $relation->id?>"><?= $relation->description?></p>
			<?php endforeach; ?>
	</fieldset>
	<?php echo $this->Form->button('Ajouter');
	echo $this->Form->end();?>

	<?php echo $c['r_associated']; ?>
</div>

