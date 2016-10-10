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
    }

    function resultSearch(){
        $search = $this->request->data['search'];
        $noeuds = $this->Noeuds->find('all', array(
            'conditions' => array(
                'noeuds.mot LIKE'=>$search.'%')));
        $this->set('noeuds',$this->paginate($noeuds));
        //$this->set('noeuds',$this->paginate($noeuds));
        //$this->render('index');
    }
}
?>