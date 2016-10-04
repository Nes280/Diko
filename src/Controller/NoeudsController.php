<?php
namespace App\Controller;

class NoeudsController extends AppController
{
	public function index()
    {
		$noeuds = $this->Noeuds->find('all', ['limit' => 20, 'order' => ['poids' => 'desc']]);
        $this->set('noeuds', $noeuds);
    }
	
	public function view($id = null)
    {
        $noeud = $this->Noeuds->get($id);
        $this->set(compact('noeud'));
    }
}
?>