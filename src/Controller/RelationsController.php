<?php
namespace App\Controller;

use Cake\Controller\Component\CookieComponent;
use Cake\Event\Event;

class RelationsController extends AppController
{
	public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Cookie');

    }
	
	public function beforeFilter(Event $event)
	{
		$this->Cookie->config('name', 'User');
		$this->Cookie->configKey('User', 'encryption', false);
		//$this->Cookie->configKey('User', 'httpOnly', false);

	}

	/*public function index()
    {
        $relations = $this->Relations->find('all');
        $this->set('relations', $relations);
		
		//Création de cookies
		$this->Cookie->write('User.name', 'checked');
		$this->Cookie->write('User.role', 'Lead');
    }*/
	
	
	public function relations()
    {
        $relations = $this->Relations->find('all');
        $this->set('relations', $relations);
		
		//Création de cookies
		$tab = array();
		$i = 0; 
		foreach ($relations as $relation){
			$this->Cookie->write('User.'. $relation->nomc , 'checked');
			$tab[$i] = $relation->nomc;
			$i = $i +1; 
		}
		
		//Lecture d'un cookie
		$c =  $this->Cookie->read('User');
		$this->set("c", $c);
		
		$start_memory = memory_get_usage();
        $temp = unserialize(serialize($c));
        $taille = memory_get_usage() - $start_memory;
		
		echo $taille .' octet(s)';
		
		//echo $c['r_associated']; 
		
		if($this->request->is('post'))
        {
			//Recuperation des données
			$d = $this->request->data;
			
			//echo sizeof($d);
			//echo sizeof($tab);
			//Obliger pour pouvoir les comparer 
			$arraye = array_combine($tab, $d);

			//Change la valeur dans le cookie
			foreach($arraye as $k => $a){
				//echo $k  . " " . $a . "\n";
				if($a === '0'){
					$this->Cookie->write('User.' . $k , '');
				}				
			}
			$c =  $this->Cookie->read('User');
			$this->set("c", $c);
			
			echo $c['r_associated'];
			echo $c['r_learning_model'];
		}
    }
	
	

    
    /*public function view($id = null)
    {
        $noeud = $this->Noeuds->get($id);
        $this->set(compact('noeud'));
    }*/
}
?>