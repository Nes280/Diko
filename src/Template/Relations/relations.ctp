</br>
</br>
<div class="row">
	<form>
		<fieldset class="fieldset">
			<legend>Choix des relations à afficher </legend>
			<?php foreach ($relations as $relation): ?>
				<input id="<?= $relation->id?>" type="checkbox" checked>
				<label for="<?= $relation->id?>">
					<B><?= $relation->noml ?></B>
				</label>
				<p class="help-text" id="<?= $relation->id?>"><?= $relation->description?></p>
			<?php endforeach; ?>
		</fieldset>
		<button type="button" class="button">Enregistrer</button>
	</form>
	<?= $c ?>
</div>
</br>