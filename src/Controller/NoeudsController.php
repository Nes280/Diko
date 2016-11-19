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
		
		 
		//$donnees = $this->Noeuds->query("SELECT r.noml, n2.mot FROM `Aretes` as a, `Noeuds` as n1, `Noeuds` as n2, `Relations` as r WHERE a.mot1 = n1.id and a.mot2 = n2.id and a.rel = r.id and n1.id ={$id} order by r.noml asc, n2.poids desc;");
		/*$options['contain']=array('Noeuds', 'Relations');
		$options['joins']=array(
             array(
                'table' => 'aretes', 
				'alias' => 'a'),
            array(
                'table' => 'noeuds',
                'alias' => 'n1',
				"type" => "INNER",
                'conditions' => array('n1.id = a.mot1')
                ),
			array(
                'table' => 'noeuds',
                'alias' => 'n2',
				"type" => "INNER",
                'conditions' => array('n2.id = a.mot1')
                ),
			array(
                'table' => 'relations',
                'alias' => 'r',
				"type" => "INNER",
                'conditions' => array('r.id = a.rel')
                )
            );
        $options['conditions'] = array(
            'n1.id' => $id
            );
        $options['fields'] = array(
            'r.noml', 'n2.mot'
            );
		$options['order'] = array('r.noml' => 'asc', 'n2.poids' => 'desc'); 
		$donnees = $this->Noeuds->Aretes->find('all',$options);*/
		
		
		/*$donnees = $this->Noeuds->Aretes->find('all', array(
			'joins' => array(
				array(
					'table' => 'noeuds',
					'alias' => 'NoeudsJoin',
					'type' => 'INNER',
					'conditions' => array(
						'NoeudsJoin.id = Aretes.mot2'
					)
				)
			),
			'conditions' => array(
				'Aretes.mot1' => $id
			),
			'fields' => array('NoeudsJoin.*', 'Aretes.*'),
			'order' => 'Aretes.rel DESC'
		));*/
		
		/*$donnees = $this->Noeuds->find('all', array(
            'fields' => array('Noeud.*','AretesAlias.*'),
            'joins' => array(
                array(
                        'table' => 'Aretes',
                        'alias' => 'AretesAlias',
                        'type' => 'INNER',
                        'conditions' => array(
                        'AretesAlias.mot2' =>'Noeuds.id' 
                        )
                    ),
                ),
			'conditions' => array('AretesAlias.mot1' => $id)
            )
        );
		
		$compteur =0;
		foreach($donnees as $donnee){
			if(substr($donnee->mot, 0, 1) != "_" AND substr($donnee->mot, 0, 1) != ":"){
				echo $donnee->rel . " " . $donnee->mot . " \n"; 
				$tab[] = $donnee;
				$compteur++;
			}
		}
		echo print_r($tab);
		//$this->set('relationMots',$tab);*/
		
        
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
        $donnee = $this->paginate($data);
        $this->set('r_associated',$donnee);
		
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