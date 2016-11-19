<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class AretesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
		$this->hasMany('Relations', [
            'className' => 'Relations'
        ]);
		$this->hasMany('Noeuds', [
            'className' => 'Noeuds'
        ]);
    }
}
?>