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
	Diko
    </title>
    <?= $this->Html->meta('icon') ?>
	
    <?= $this->Html->css('foundation.css') ?>
    <?= $this->Html->css('foundation-icons.css') ?>
    <?= $this->Html->css('perso.css') ?>
    <?= $this->Html->script('vendor/jquery.js') ?>
    <?= $this->Html->script('vendor/foundation.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="top-bar">
  <div class="top-bar-title">
    <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
      <button class="menu-icon dark" type="button" data-toggle></button>
    </span>
    <h3><strong>Diko</strong></h3>
  </div>
  <div id="responsive-menu">
    <div class="top-bar-left">
      <ul class="dropdown menu" data-dropdown-menu>
        <li>
          <a href="#">One</a>
          <ul class="menu vertical">
            <li><a href="#">One</a></li>
            <li><a href="#">Two</a></li>
            <li><a href="#">Three</a></li>
          </ul>
        </li>
        <li><a href="#">Two</a></li>
        <li><a href="Relations/index">Relation</a></li>
      </ul>
    </div>
    <div class="top-bar-right">
      <!--ul class="menu">
        <li><input type="search" placeholder="Recherche"></li>
        <li><button type="button" class="button">Recherche</button></li>
      </ul!-->
      <?php //echo $this->Form->create('Post',array('id' => 'textBox', 'type' => 'post','url' => array('controller' => 'noeuds', 'action' => 'resultSearch'))); ?>
                <?php //echo $this->Form->input('search', array('label'=>"",'placeholder'=>'Rechercher','id'=>'search')); ?>
              <?php //echo $this->Form->end(); ?>
      
    </div>
  </div>
</div>
<input type="text" id="searchBox" class="search-field" placeholder="Recherche"  />
      <ul id="searchResults" class="term-list hidden" ></ul>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <div class="footer">
      <p> Auteurs : Elsa Martel et Niels Benichou - Année 2016 2017 </p>
    </div>
	 <script type="text/javascript" src="webroot/js/vendor/recherche.js"></script>
    <script>
	   $(document).foundation();
    </script>

</body>
</html>
