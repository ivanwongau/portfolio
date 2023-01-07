<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clinicians Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ClinicianQualificationsTable&\Cake\ORM\Association\HasMany $ClinicianQualifications
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsToMany $Clients
 *
 * @method \App\Model\Entity\Clinician newEmptyEntity()
 * @method \App\Model\Entity\Clinician newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clinician[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clinician get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clinician findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clinician patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clinician[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clinician|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clinician saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clinician[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clinician[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clinician[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clinician[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CliniciansTable extends Table
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

        $this->setTable('clinicians');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'dependent' => true,
            'cascadeCallbacks' => true,

        ]);
        $this->hasMany('ClinicianQualifications', [
            'foreignKey' => 'clinician_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsToMany('Clients', [
            'foreignKey' => 'clinician_id',
            'targetForeignKey' => 'client_id',
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
            ->scalar('medical_specialty')
            ->maxLength('medical_specialty', 128)
            ->allowEmptyString('medical_specialty');

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
