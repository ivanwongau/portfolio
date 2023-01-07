<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PropertyStorageFolders Model
 *
 * @property \App\Model\Table\PropertiesTable&\Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\PropertyStorageFolder get($primaryKey, $options = [])
 * @method \App\Model\Entity\PropertyStorageFolder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFolder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFolder|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyStorageFolder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyStorageFolder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFolder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyStorageFolder findOrCreate($search, callable $callback = null, $options = [])
 */
class PropertyStorageFoldersTable extends Table
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

        $this->setTable('property_storage_folders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('PropertyStorageFiles', [
            'foreignKey' => 'folder_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('PropertyStorageFoldersUsers', [
            'foreignKey' => 'property_storage_folder_id',
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('folder_name')
            ->maxLength('folder_name', 50)
            ->requirePresence('folder_name', 'create')
            ->notEmptyString('folder_name');

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
