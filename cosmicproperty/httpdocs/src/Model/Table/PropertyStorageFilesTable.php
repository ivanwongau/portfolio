<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PropertyStorageFiles Model
 *
 * @property \App\Model\Table\PropertyStorageFoldersTable&\Cake\ORM\Association\BelongsTo $PropertyStorageFolders
 *
 * @method \App\Model\Entity\PropertyStorageFile get($primaryKey, $options = [])
 * @method \App\Model\Entity\PropertyStorageFile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyStorageFile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyStorageFile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFile findOrCreate($search, callable $callback = null, $options = [])
 */
class PropertyStorageFilesTable extends Table
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

        $this->setTable('property_storage_files');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PropertyStorageFolders', [
            'foreignKey' => 'folder_id',
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
            ->scalar('file_name')
            ->maxLength('file_name', 50)
            ->requirePresence('file_name', 'create')
            ->notEmptyFile('file_name');

        $validator
            ->integer('uploaded_by')
            ->requirePresence('uploaded_by', 'create')
            ->notEmptyString('uploaded_by');

        $validator
            ->date('uploaded_date')
            ->requirePresence('uploaded_date', 'create')
            ->notEmptyDate('uploaded_date');

        $validator
            ->scalar('file_details')
            ->maxLength('file_details', 500)
            ->allowEmptyFile('file_details');

        $validator
            ->scalar('file_path')
            ->maxLength('file_path', 8000)
            ->requirePresence('file_path', 'create')
            ->notEmptyFile('file_path');

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
        $rules->add($rules->existsIn(['folder_id'], 'PropertyStorageFolders'));

        return $rules;
    }
}
