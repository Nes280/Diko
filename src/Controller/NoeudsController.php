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
        $noeuds = $this->Noeuds->find('all', ['limit' => 50, 'order' => ['poids' => 'desc']])->where(function ($exp, $q) {
					return $exp->notLike('mot', '%\_%');
				});
        $this->set('noeuds', $noeuds);
    }
    
    public function view($id = null)
    {

        $noeud = $this->Noeuds->get($id);
        $this->set(compact('noeud'));
        //$this->set('r_associated',$this->request->session()->read('User.r_associated'));
		
		$val = '0'; 
		//Polarité du mot négative
		$optionsNeg = array(
            'fields' => array(
                'Aretes.poids'
            ),
            'conditions' => array(
                'Aretes.mot1' => $id, 
				'Aretes.mot2' => '254878'
            )
        );
		$negatif = $this->Noeuds->Aretes->find('all', $optionsNeg);
		$this->set('negatif', $val);
		foreach ($negatif as $neg) {
			$this->set('negatif', $neg->poids);
		}
		
		//Polarité du mot neutre
		$optionsNeu = array(
            'fields' => array(
                'Aretes.poids'
            ),
            'conditions' => array(
                'Aretes.mot1' => $id, 
				'Aretes.mot2' => '254877'
            )
        );
		$neutre = $this->Noeuds->Aretes->find('all', $optionsNeu);
		$this->set('neutre', $val);
		foreach ($neutre as $neu) {
			$this->set('neutre', $neu->poids);
		}
		
		//Polarité du mot positive
		$optionsPos = array(
            'fields' => array(
                'Aretes.poids'
            ),
            'conditions' => array(
                'Aretes.mot1' => $id, 
				'Aretes.mot2' => '254876'
            )
        );
		$positif = $this->Noeuds->Aretes->find('all', $optionsPos);
		$this->set('positif', $val);
		foreach ($positif as $pos) {
			$this->set('positif', $pos->poids);
		}
		
        //recupere les relations en session
        $name = $this->request->session()->read("diko");
		echo $name;
		$this->set('session', $name);
        if ($name === 'session') {
            $relations = $this->request->session()->read("User");
            $this->set('relations', $relations);
        }
        //else A FAIRE, RECUPERER TOUTES LES RELATIONS EN BD



		//les definitions
        $query = $this->Noeuds->findById($id)->contain(['Definitions']);
        foreach ($query as $def) {
            $this->set('def', $def);
        }
        
        //requête qui va recuperer le mot et la relation dans Aretes
        $options = array(
            'fields' => array(
                'Aretes.mot2', 
				'Aretes.rel'
            ),
            'conditions' => array(
                'Aretes.mot1' => $id
            ),
            'order' =>array(
				'Aretes.rel' => 'desc',
                'Aretes.poids' => 'desc'				 
            )
        );
        $identifiant = $this->Noeuds->Aretes->find('all', $options);
        
		//On construit 2 tableaux un pour les mots et un pour les relations
		$compteur = 0;
		$tabMot;
		$tabRel;
        foreach ($identifiant as $i) {
            $tabMot[$compteur] = $i->mot2;
			$tabRel[$compteur] = $i->rel;
            $compteur++;
        }
		//echo sizeof($tabMot) . " = " .sizeof($tabRel);
        
		//Requete qui va chercher l'id et le mot dans Noeud
        $options2 = array(
            'fields' => array(
                'Noeuds.mot',
                'Noeuds.id'
            ),
            'conditions' => array(
                'Noeuds.id IN' => $tabMot
            ),
        );
        $data = $this->Noeuds->find('all', $options2);
        
		//On construit un tableau contenant les mots à recuperer
		$compteur = 0;
		$tabMotAAfficher;
        foreach ($data as $d) {
            if (substr($d->mot, 0, 1) != "_" AND substr($d->mot, 0, 1) != ":") {
                $tabMotAAfficher[$compteur]= $d;
                str_replace("\'", "'", $d->mot);
                //$table.= "<a href=\"/diko/noeuds/view/$d->id\">".$d->mot."</a>";
                $compteur++;
            }
        }
        /*$donnee = $this->paginate($data);
        $this->set('r_associated',$donnee);*/
		
		//Requete qui va chercher le noml et l'id dans Relation
		$options3 = array(
            'fields' => array(
                'Relations.noml',
                'Relations.id'
            ),
            'conditions' => array(
                'Relations.id IN' => $tabRel
            ),
        );
		$relations = $this->Noeuds->Aretes->Relations->find('all', $options3);
		$tabRelationAAfficher;
		$compteur = 0;	
		foreach($relations as $relation){
			$tabRelationAAfficher[$compteur] = $relation;
			$compteur++;
		}
		//echo sizeof($tabRelationAAfficher);
		
		//Tableaux pour l'affichage
		//Parcours des relations possibles
		$tabRetour;
		for($i = 0; $i < sizeof($tabRelationAAfficher); $i++){
			//Parcours des id des relations (requete 1)
			$tabMotRel = null;
			$compteurMot = 0;
			for($j = 0; $j < sizeof($tabRel); $j++){
				//Meme relation
				if($tabRel[$j] === $tabRelationAAfficher[$i]->id){
					//on parcours les mots
					for($k = 0; $k < sizeof($tabMotAAfficher); $k++){
						//le mot est à afficher
						if($tabMotAAfficher[$k]->id === $tabMot[$j]){
							$tabMotRel[$compteurMot] = array($tabMotAAfficher[$k]->id, $tabMotAAfficher[$k]->mot);
							$compteurMot++;
						}
					}
				}
			}
			if(sizeof($tabMotRel)>0){
				$tabRetour[$tabRelationAAfficher[$i]->noml] = $tabMotRel; 
                foreach ($tabMotRel as $key) {
                    foreach ($key as $key2 => $value2) {
                    }
                }
			}
			
		}
		
		//print_r($tabRetour);
		
		$this->set('relationMots',$tabRetour);
		
        /*
        if(($n = Cache::read('cache_'.$id)) !== false)
        {
            $this->set('data',$n);
        }
        else
        {
            //$donnee = $this->paginate($data->cache('cache_'.$id));
            //$donnee = $this->paginate();
            $this->set('r_associated',$donnee);
        }
        */
        

    }

}

?>