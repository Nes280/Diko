<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class AretesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
		$this->hasMany('Relations', [
            'className' => 'Relations',
			['foreignKey' => ['id'],
			 'bindingKey' => [ 'rel']]
			
        ]);
		$this->hasMany('Noeuds', [
            'className' => 'Noeuds', 
			['foreignKey' => ['id', 'id'],
			 'bindingKey' => [ 'mot1', 'mot2']]
		]);
    }
}
?>