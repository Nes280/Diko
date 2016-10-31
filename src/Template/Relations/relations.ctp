</br>
</br>
<div class="row">
	<div>
		<fieldset class="fieldset">
			<?php echo $this->Form->create('Cocher',['type' => 'get']);
			echo $this->Form->radio('cocher_decocher',
				[
					['value' => 'cocher', 'text' => 'Tout cocher'],
					['value' => 'decocher', 'text' => 'Tout decocher']
				]);		
			echo $this->Form->button('Valider');
			echo $this->Form->end();?>
		</fieldset>
	</div>
	<div>
		<?php echo $this->Form->create('Relations');?>
		<fieldset class="fieldset">
			<legend>Choix des relations à afficher </legend>
				<?php foreach ($relations as $relation): ?>
					<B> 
						<?php echo $this->Form->input("$relation->noml", ['type' => 'checkbox', 'id' => "$relation->id", 'value' => "$relation->nomc", $c[$relation->nomc]]);?>
					</B>
					<p class="help-text" id="<?= $relation->id?>"><?= $relation->description?></p>
				<?php endforeach; ?>
			<?php echo $this->Form->button('Ajouter');
			echo $this->Form->end();?>
		</fieldset>

		</br>
		</br>
	</div>
</div>