<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \App\Model\Table\ItemFoldersTable&\Cake\ORM\Association\BelongsTo $ItemFolders
 * @property \App\Model\Table\BcrImagesTable&\Cake\ORM\Association\HasMany $BcrImages
 * @property \App\Model\Table\ItemImagesTable&\Cake\ORM\Association\HasMany $ItemImages
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemsTable extends Table
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

        $this->setTable('items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ItemFolders', [
            'foreignKey' => 'folder_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('ItemImages', [
            'foreignKey' => 'item_id',
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
            ->scalar('item_name')
            ->maxLength('item_name', 50)
            ->allowEmptyString('item_name');

        $validator
            ->numeric('item_quantity')
            ->allowEmptyString('item_quantity');

        $validator
            ->scalar('item_unit_of_mes')
            ->maxLength('item_unit_of_mes', 50)
            ->allowEmptyString('item_unit_of_mes');

        $validator
            ->numeric('item_rate')
            ->allowEmptyString('item_rate');

        $validator
            ->numeric('item_total')
            ->allowEmptyString('item_total');

        $validator
            ->scalar('item_allowance')
            ->maxLength('item_allowance', 50)
            ->allowEmptyString('item_allowance');

        $validator
            ->scalar('item_condition')
            ->maxLength('item_condition', 50)
            ->allowEmptyString('item_condition');

        $validator
            ->numeric('year_due')
            ->allowEmptyString('year_due');

        $validator
            ->numeric('expected_life')
            ->allowEmptyString('expected_life');

        $validator
            ->scalar('expected_year_due')
            ->requirePresence('expected_year_due', 'create')
            ->notEmptyString('expected_year_due');



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
        $rules->add($rules->existsIn(['folder_id'], 'ItemFolders'));

        return $rules;
    }
}
