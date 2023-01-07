<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemMaintenances Model
 *
 * @property \App\Model\Table\PropertiesTable&\Cake\ORM\Association\BelongsTo $Properties
 * @property &\Cake\ORM\Association\HasMany $ItemComments
 *
 * @method \App\Model\Entity\ItemMaintenance get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemMaintenance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemMaintenance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemMaintenance|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemMaintenance saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemMaintenance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemMaintenance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemMaintenance findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemMaintenancesTable extends Table
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

        $this->setTable('item_maintenances');
        $this->setDisplayField('item_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ItemComments', [
            'foreignKey' => 'item_maintenance_id',
        ]);
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
            ->scalar('item_name')
            ->maxLength('item_name', 255)
            ->requirePresence('item_name', 'create')
            ->notEmptyString('item_name');

        $validator
            ->scalar('item_status')
            ->maxLength('item_status', 255)
            ->requirePresence('item_status', 'create')
            ->notEmptyString('item_status');

        $validator
            ->scalar('item_location')
            ->maxLength('item_location', 255)
            ->requirePresence('item_location', 'create')
            ->notEmptyString('item_location');

        $validator
            ->scalar('item_finding')
            ->maxLength('item_finding', 255)
            ->requirePresence('item_finding', 'create')
            ->notEmptyString('item_finding');

        $validator
            ->scalar('item_recommendation')
            ->maxLength('item_recommendation', 255)
            ->requirePresence('item_recommendation', 'create')
            ->notEmptyString('item_recommendation');

        $validator
            ->scalar('cost_estimate')
            ->maxLength('cost_estimate', 255)
            ->requirePresence('cost_estimate', 'create')
            ->notEmptyString('cost_estimate');

        $validator
            ->scalar('potential_hazard')
            ->maxLength('potential_hazard', 255)
            ->requirePresence('potential_hazard', 'create')
            ->notEmptyString('potential_hazard');

        $validator
            ->scalar('item_priority')
            ->maxLength('item_priority', 6)
            ->requirePresence('item_priority', 'create')
            ->notEmptyString('item_priority');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['property_id'], 'Properties'));

        return $rules;
    }
}
