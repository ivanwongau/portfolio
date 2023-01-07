<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clients Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ClientConditionsTable&\Cake\ORM\Association\HasMany $ClientConditions
 * @property \App\Model\Table\FoodIntakesTable&\Cake\ORM\Association\HasMany $FoodIntakes
 * @property \App\Model\Table\CliniciansTable&\Cake\ORM\Association\BelongsToMany $Clinicians
 *
 * @method \App\Model\Entity\Client newEmptyEntity()
 * @method \App\Model\Entity\Client newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('clients');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('ClientConditions', [
            'foreignKey' => 'client_id',
            'dependent' => true,
        ]);
        $this->hasMany('FoodIntakes', [
            'foreignKey' => 'client_id',
            'dependent' => true,
        ]);
        $this->belongsToMany('Clinicians', [
            'foreignKey' => 'client_id',
            'targetForeignKey' => 'clinician_id',
            'joinTable' => 'clients_clinicians',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('diabetes_type')
            ->maxLength('diabetes_type', 64)
            ->requirePresence('diabetes_type', 'create')
            ->notEmptyString('diabetes_type');

        $validator
            ->integer('past_births')
            ->requirePresence('past_births', 'create')
            ->notEmptyString('past_births');

        $validator
            ->scalar('medicare_no')
            ->maxLength('medicare_no', 16)
            ->allowEmptyString('medicare_no');

        $validator
            ->integer('medicare_ref')
            ->allowEmptyString('medicare_ref');

        $validator
            ->scalar('medical_history')
            ->allowEmptyString('medical_history');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
