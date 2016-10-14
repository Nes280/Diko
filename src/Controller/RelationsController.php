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
			$this->Cookie->write('User.'. $relation->nomc , 'true');
			$tab[$i] = $relation->nomc;
			$i = $i +1; 
		}
		
		//Lecture d'un cookie
		$c =  $this->Cookie->read('User');
		$this->set("c", $c);
		
		echo $c['r_associated']; 
		
		if($this->request->is('post'))
        {
			//Recuperation des données
			$d = $this->request->data;
			
			//Obliger pour pouvoir les comparer 
			$arraye = array_combine($tab, $d);

			//Change la valeur dans le cookie
			foreach($arraye as $k => $a){
				echo $k  . " " . $a . "\n";
				if($a === '0'){
					$this->Cookie->write('User.' . $k , 'false');
				}
				
			}
			
			$c =  $this->Cookie->read('User');
			$this->set("c", $c);
		}
    }
	
    
    /*public function view($id = null)
    {
        $noeud = $this->Noeuds->get($id);
        $this->set(compact('noeud'));
    }*/
}
?>