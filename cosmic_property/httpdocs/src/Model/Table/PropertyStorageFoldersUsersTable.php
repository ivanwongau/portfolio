<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PropertyStorageFoldersUsers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PropertyStorageFoldersTable&\Cake\ORM\Association\BelongsTo $PropertyStorageFolders
 *
 * @method \App\Model\Entity\PropertyStorageFoldersUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\PropertyStorageFoldersUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFoldersUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFoldersUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyStorageFoldersUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyStorageFoldersUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFoldersUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFoldersUser findOrCreate($search, callable $callback = null, $options = [])
 */
class PropertyStorageFoldersUsersTable extends Table
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

        $this->setTable('property_storage_folders_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PropertyStorageFolders', [
            'foreignKey' => 'property_storage_folder_id',
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
            ->integer('folder_access_level')
            ->requirePresence('folder_access_level', 'create')
            ->notEmptyString('folder_access_level');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['property_storage_folder_id'], 'PropertyStorageFolders'));

        return $rules;
    }
}
