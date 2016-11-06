<?php
namespace App\Controller;
use Cake\Cache\Cache;

class NoeudsController extends AppController
{
    public $paginate = [
        'limit' => 30
        
    ];

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
        //$table="[";
        foreach ($data as $d) {
            if ($compteur>0 AND substr($d->mot, 0, 1) != "_" AND substr($d->mot, 0, 1) != ":") {
                //$table.= ",";
            }
            if (substr($d->mot, 0, 1) != "_" AND substr($d->mot, 0, 1) != ":") {
                $tab2[$compteur]= $d;
                str_replace("\'", "'", $d->mot);
                //$table.= "<a href=\"/diko/noeuds/view/$d->id\">".$d->mot."</a>";
                $compteur++;
            } 
        }
        if(($n = Cache::read('cache_'.$id)) !== false)
        {
            $this->set('data',$n);
        }
        else
        {
            $donnee = $this->paginate($data->cache('cache_'.$id));
            $this->set('data',$donnee);
        }

    }

}

?>