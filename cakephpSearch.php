<?php
	$hote='localhost';
	$port='3306';
	$base='cakephp';
	$util='cakephp';
	$motP='kaleigh34';
	$p = htmlentities($_GET['param']);
	
	$cherche = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$base, $util, $motP);
	$req = $cherche->prepare('SELECT * FROM noeuds WHERE mot like :input order by poids DESC limit 5 ');
	$req->execute(array(':input' => $p . '%'));
	$req->setFetchMode(PDO::FETCH_OBJ);
	$count = $req->rowCount();
	$i = 0;

	while ($res = $req->Fetch())
	{
		echo "<p><a href='/diko/noeuds/view/$res->id'>".html_entity_decode($res->mot)."</a></p>";
		$i = $i +1;
	}

	if ($i == 0) {
		echo "<p>".html_entity_decode("Pas de résultat")."</p>";
	}
?>