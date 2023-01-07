<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClinicianQualifications Model
 *
 * @property \App\Model\Table\CliniciansTable&\Cake\ORM\Association\BelongsTo $Clinicians
 *
 * @method \App\Model\Entity\ClinicianQualification newEmptyEntity()
 * @method \App\Model\Entity\ClinicianQualification newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ClinicianQualification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClinicianQualification get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClinicianQualification findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ClinicianQualification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClinicianQualification[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClinicianQualification|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClinicianQualification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClinicianQualification[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClinicianQualification[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClinicianQualification[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClinicianQualification[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClinicianQualificationsTable extends Table
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

        $this->setTable('clinician_qualifications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clinicians', [
            'foreignKey' => 'clinician_id',
            'joinType' => 'INNER',
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
            ->scalar('qualification')
            ->maxLength('qualification', 128)
            ->requirePresence('qualification', 'create')
            ->notEmptyString('qualification');

        $validator
            ->dateTime('date_expire')
            ->notEmptyDateTime('date_expire');

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
        $rules->add($rules->existsIn(['clinician_id'], 'Clinicians'), ['errorField' => 'clinician_id']);

        return $rules;
    }
}
