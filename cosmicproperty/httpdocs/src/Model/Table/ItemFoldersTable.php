<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemFolders Model
 *
 * @property \App\Model\Table\PropertiesTable&\Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\ItemFolder get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemFolder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemFolder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemFolder|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemFolder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemFolder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemFolder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemFolder findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemFoldersTable extends Table
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

        $this->setTable('item_folders');
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
            ->scalar('folder_name')
            ->maxLength('folder_name', 255)
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
