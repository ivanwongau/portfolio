<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LotOwners Model
 *
 * @property \App\Model\Table\PropertyMultiOwnershipsTable&\Cake\ORM\Association\BelongsTo $PropertyMultiOwnerships
 *
 * @method \App\Model\Entity\LotOwner get($primaryKey, $options = [])
 * @method \App\Model\Entity\LotOwner newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LotOwner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LotOwner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LotOwner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LotOwner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LotOwner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LotOwner findOrCreate($search, callable $callback = null, $options = [])
 */
class LotOwnersTable extends Table
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

        $this->setTable('lot_owners');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PropertyMultiOwnerships', [
            'foreignKey' => 'ownership_id',
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
            ->scalar('lots_no')
            ->maxLength('lots_no', 255)
            ->requirePresence('lots_no', 'create')
            ->notEmptyString('lots_no');

        $validator
            ->scalar('no_liabilities')
            ->maxLength('no_liabilities', 255)
            ->requirePresence('no_liabilities', 'create')
            ->notEmptyString('no_liabilities');

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
        $rules->add($rules->existsIn(['ownership_id'], 'PropertyMultiOwnerships'));

        return $rules;
    }
}
