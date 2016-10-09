<?php
namespace App\Controller;

class RelationsController extends AppController
{
	public function index()
    {
        $relations = $this->Relations->find('all');
        $this->set('relations', $relations);
    }
    
    /*public function view($id = null)
    {
        $noeud = $this->Noeuds->get($id);
        $this->set(compact('noeud'));
    }*/
}
?>