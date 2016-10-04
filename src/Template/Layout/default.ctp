<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>

<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Dictionnaire
		</title>
		<?= $this->Html->meta('icon') ?>

		<?= $this->Html->css('foundation.min') ?>
		<?= $this->Html->script('vendor/jquery.js') ?>
		<?= $this->Html->script('vendor/fastclick.js') ?>
		<?= $this->Html->script('foundation.min.js') ?>

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>
	</head>
	<body>
		<nav class="top-bar expanded" data-topbar role="navigation">
				<h1><a href="">Dictionnaire <!--<?= $this->fetch('title') ?>--> </a></h1>
		</nav>
		<?= $this->Flash->render() ?>
		<div class="container">
			<div class="panel">
				<?= $this->fetch('content') ?>
			</div>
			
			<div id="footer">
				<div class='row'>
					<div class='large-12 columns'>
						<!--<p> Auteurs : Elsa Martel et Niels Benichou - Année 2016 2017 </p>-->
					</div>
				</div>
			</div>
		</div>

		<script>
		  $(document).foundation();
		</script>

	</body>
</html>
