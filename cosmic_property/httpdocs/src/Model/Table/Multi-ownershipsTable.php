<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Multi-ownerships Model
 *
 * @property \App\Model\Table\BuildingsTable&\Cake\ORM\Association\BelongsTo $Buildings
 *
 * @method \App\Model\Entity\Multi-ownership get($primaryKey, $options = [])
 * @method \App\Model\Entity\Multi-ownership newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Multi-ownership[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Multi-ownership|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Multi-ownership saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Multi-ownership patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Multi-ownership[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Multi-ownership findOrCreate($search, callable $callback = null, $options = [])
 */
class Multi-ownershipsTable extends Table
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

        $this->setTable('multi_ownerships');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Buildings', [
            'foreignKey' => 'building_id',
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
            ->scalar('owner_corporation_number')
            ->maxLength('owner_corporation_number', 7)
            ->allowEmptyString('owner_corporation_number');

        $validator
            ->integer('number_lot')
            ->requirePresence('number_lot', 'create')
            ->notEmptyString('number_lot');

        $validator
            ->integer('number_lot_liability')
            ->requirePresence('number_lot_liability', 'create')
            ->notEmptyString('number_lot_liability');

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
        $rules->add($rules->existsIn(['building_id'], 'Buildings'));

        return $rules;
    }
}
