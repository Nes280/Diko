<?php
namespace App\Controller;

use Cake\Controller\Component\CookieComponent;
use Cake\Event\Event;

class RelationsController extends AppController
{

	public function relations()
    {
		//Requêtes pour avoir les relations
        $relations = $this->Relations->find('all');
        $this->set('relations', $relations);
		
		//Création de tableau pour après
		$tab = array();
		$c = array();
		
		$r = $this->request->session()->read("diko");
		//Si il y a pas de sessions avant
		if($r !== 'true'){
			//Création des variables de sessions
			$i = 0; 
			foreach ($relations as $relation){
				$this->request->session()->write('User.'. $relation->nomc , 'checked');
				$c[$relation->nomc] = 'checked'; 
				$tab[$i] = $relation->nomc;
				$i = $i +1; 
			}
			$this->request->session()->write('diko', 'true');
		}
		else{
			//initialisation des tableaux
			$i = 0; 
			foreach ($relations as $relation){
				$tab[$i] = $relation->nomc;
				$c[$relation->nomc] =  $this->request->session()->read('User.'. $relation->nomc);
				$i = $i +1; 
			}
			
		}
		
		//echo $c['r_associated']; 
		
		if($this->request->is('get')){
			$d = $this->request->query; 
			if(sizeof($d) === 1){
				$r = false; 
				if($d['cocher_decocher'] === 'cocher'){
					$action = 'checked';
					$r = true;
				}
				else if($d['cocher_decocher'] === 'decocher'){
					$action = ' ';
					$r = true;
				}
				if($r){
					$i = 0; 
					foreach ($relations as $relation){
						$this->request->session()->write('User.'. $relation->nomc , $action);
						$c[$relation->nomc] = $action; 
						$tab[$i] = $relation->nomc;
						$i = $i +1; 
					}
				}
			}
		}
		
		
		if($this->request->is('post'))
        {
			//Recuperation des données
			$d = $this->request->data;
			
			//Obliger pour pouvoir les comparer 
			$arraye = array_combine($tab, $d);

			//Change la valeur dans la session
			foreach($arraye as $k => $a){
				//echo $k  . " " . $a . "\n";
				if($a === '0'){
					$this->request->session()->write('User.'. $k , ' ');
					$c[$k]=' ';				
				}
				else{
					$this->request->session()->write('User.'. $k , 'checked');
					$c[$k]='checked';				
				}
			}

		}
		

		
		//On partage le tableau c qui contient les valeurs de sessions
		$this->set("c", $c);
    }
}
?>