<?php
namespace App\Controller;

class RelationsController extends AppController
{
	public function index()
    {
        $relations = $this->Relations->find('all');
        $this->set('relations', $relations);
		
		//Création de cookies
		/*$this->Cookie->write('User.name', 'Larry');
		$this->Cookie->write('User.role', 'Lead');*/
    }
	
	public function relations()
    {
        $relations = $this->Relations->find('all');
        $this->set('relations', $relations);
		
		//Création de cookies
		/*$this->Cookie->write('User.name', 'Larry');
		$this->Cookie->write('User.role', 'Lead');*/
    }
    
    /*public function view($id = null)
    {
        $noeud = $this->Noeuds->get($id);
        $this->set(compact('noeud'));
    }*/
}
?>