<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class NoeudsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->hasMany('Definitions', [
            'className' => 'Definitions'
        ]);
        $this->hasMany('Aretes', [
            'className' => 'Aretes', 
			['foreignKey' => ['mot1', 'mot2' ],
			 'bindingKey' => [ 'id', 'id' ]]
        ]);
		
    }
}
?>