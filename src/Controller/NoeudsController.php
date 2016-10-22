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
        $this->set('r_associated',$this->request->session()->read('User.r_associated'));

        $query = $this->Noeuds->findById($id)->contain(['Definitions']);
        foreach ($query as $def) {
            $this->set('def', $def);
        }
        
        $options = array(
            'fields' => array(
                'Aretes.mot2'
            ),
            'conditions' => array(
                'Aretes.mot1' => $id
            ),
            'order' =>array(
                 'Aretes.poids' => 'desc'   
            ),
            'limit' => 10
        );

        $identifiant = $this->Noeuds->Aretes->find('all', $options);
        foreach ($identifiant as $i) {
            $this->set('identifiant', $i);
        }
         
        $options = array(
            'fields' => array(
                'Noeuds.mot',
            ),
            'conditions' => array(
                'Noeuds.id' => $i->mot2
            ),
        );
        $data = $this->Noeuds->find('all', $options);

        foreach ($data as $d) {
            $this->set('data', $d);
        }

    }

}

?>