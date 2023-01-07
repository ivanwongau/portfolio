<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PropertyMultiOwnerships Model
 *
 * @property \App\Model\Table\PropertiesTable&\Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\PropertyMultiOwnership get($primaryKey, $options = [])
 * @method \App\Model\Entity\PropertyMultiOwnership newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PropertyMultiOwnership[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PropertyMultiOwnership|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyMultiOwnership saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyMultiOwnership patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyMultiOwnership[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyMultiOwnership findOrCreate($search, callable $callback = null, $options = [])
 */
class PropertyMultiOwnershipsTable extends Table
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

        $this->setTable('property_multi_ownerships');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER',
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
            ->scalar('owner_corp_num')
            ->maxLength('owner_corp_num', 50)
            ->allowEmptyString('owner_corp_num');

        $validator
            ->integer('Num_of_lot')
            ->requirePresence('Num_of_lot', 'create')
            ->notEmptyString('Num_of_lot');

        $validator
            ->integer('Num_of_lot_liabilities')
            ->requirePresence('Num_of_lot_liabilities', 'create')
            ->notEmptyString('Num_of_lot_liabilities');
            
        $validator
            ->date('plan_registration_date')
            ->allowEmptyDate('plan_registration_date');
         $validator
            ->scalar('strata_plan_number')
            ->maxLength('strata_plan_number', 255)
            ->allowEmptyString('strata_plan_number');

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
