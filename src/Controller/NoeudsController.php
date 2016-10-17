<?php
namespace App\Controller;

class NoeudsController extends AppController
{
	public function index()
    {
        $noeuds = $this->Noeuds->find('all', ['limit' => 50, 'order' => ['poids' => 'desc']]);
        $this->set('noeuds', $noeuds);
    }
    
    public function view($id = null)
    {
        $noeud = $this->Noeuds->get($id);
        $this->set(compact('noeud'));
		//echo $this->request->session()->read('User.r_associated');

        $query = $this->Noeuds->findById($id)->contain(['Definitions']);
        foreach ($query as $user) {
            $this->set('def', $user);
        //echo $user->definitions[0]->def;
        }	
    }
}
?>