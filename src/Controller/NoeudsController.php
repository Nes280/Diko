<?php
namespace App\Controller;

class NoeudsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    } 

	public function index()
    {
        $noeuds = $this->Noeuds->find('all', ['limit' => 50, 'order' => ['poids' => 'desc']]);
        $this->set('noeuds', $noeuds);
    }
    
    public function view($id = null)
    {
        $paginate = [
            'limit' => 25
        ];

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
            )
        );

        $identifiant = $this->Noeuds->Aretes->find('all', $options);
        $compteur = 0;
        foreach ($identifiant as $i) {
            //$this->set('identifiant', $i);
            $tab[$compteur] = $i->mot2;
            $compteur++;
        }
         
        $options2 = array(
            'fields' => array(
                'Noeuds.mot',
                'Noeuds.id'
            ),
            'conditions' => array(
                'Noeuds.id IN' => $tab
            ),
        );
        //$data = $this->Paginator->paginate($options2, $paginate);
        $data = $this->Noeuds->find('all', $options2);
        $compteur = 0;
        foreach ($data as $d) {
            if (substr($d->mot, 0, 1) != "_" AND substr($d->mot, 0, 1) != ":") {
                $tab2[$compteur]= $d;
                $compteur++;
            } 
        }
        $this->set('data',$tab2);

    }

}

?>