<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DashboardRename Model
 *
 * @method \App\Model\Entity\DashboardRename get($primaryKey, $options = [])
 * @method \App\Model\Entity\DashboardRename newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DashboardRename[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DashboardRename|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DashboardRename saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DashboardRename patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DashboardRename[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DashboardRename findOrCreate($search, callable $callback = null, $options = [])
 */
class DashboardRenameTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('dashboard_rename');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 5000)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('System_Configured_Name')
            ->maxLength('System_Configured_Name', 5000)
            ->requirePresence('System_Configured_Name', 'create')
            ->notEmptyString('System_Configured_Name');

        $validator
            ->scalar('location')
            ->maxLength('location', 126)
            ->requirePresence('location', 'create')
            ->notEmptyString('location');

        $validator
            ->scalar('Description')
            ->maxLength('Description', 256)
            ->requirePresence('Description', 'create')
            ->notEmptyString('Description');

        return $validator;
    }
}
