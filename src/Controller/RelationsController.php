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

	public function index()
    {
        $relations = $this->Relations->find('all');
        $this->set('relations', $relations);
		
		//Création de cookies
		/*$this->Cookie->config('User', 'path', '/');
		$this->Cookie->configKey('User', [
			'expires' => '+10 days',
			'httpOnly' => true
		]);*/
		$this->Cookie->write('User.name', 'Larry');
		$this->Cookie->write('User.role', 'Lead');
    }
	
	public function relations()
    {
        $relations = $this->Relations->find('all');
        $this->set('relations', $relations);
		
		//Création de cookies
		$this->Cookie->write('User.name', 'Larry');
		$this->Cookie->write('User.role', 'Lead');
		
		$c =  $this->Cookie->read('User.name');
		$this->set("c", $c);

    }
    
    /*public function view($id = null)
    {
        $noeud = $this->Noeuds->get($id);
        $this->set(compact('noeud'));
    }*/
}
?>