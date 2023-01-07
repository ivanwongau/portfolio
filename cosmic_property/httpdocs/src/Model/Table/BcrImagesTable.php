<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BcrImages Model
 *
 * @property \App\Model\Table\ItemsTable&\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\BcrImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\BcrImage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BcrImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BcrImage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BcrImage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BcrImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BcrImage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BcrImage findOrCreate($search, callable $callback = null, $options = [])
 */
class BcrImagesTable extends Table
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

        $this->setTable('bcr_images');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ItemMaintenances', [
            'foreignKey' => 'item_id',
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
            ->scalar('image_path')
            ->maxLength('image_path', 255)
            ->requirePresence('image_path', 'create')
            ->notEmptyFile('image_path');

        $validator
            ->scalar('image_name')
            ->maxLength('image_name', 255)
            ->requirePresence('image_name', 'create')
            ->notEmptyFile('image_name');

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
        $rules->add($rules->existsIn(['item_id'], 'ItemMaintenances'));

        return $rules;
    }
}
