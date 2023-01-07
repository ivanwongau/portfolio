<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemComments Model
 *
 * @property \App\Model\Table\ItemMaintenancesTable&\Cake\ORM\Association\BelongsTo $ItemMaintenances
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ItemComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemComment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemComment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemComment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemComment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemComment findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemCommentsTable extends Table
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

        $this->setTable('item_comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ItemMaintenances', [
            'foreignKey' => 'item_maintenance_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->dateTime('create_date')
            ->notEmptyDateTime('create_date');

        $validator
            ->scalar('content')
            ->maxLength('content', 8000)
            ->allowEmptyString('content');

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
        $rules->add($rules->existsIn(['item_maintenance_id'], 'ItemMaintenances'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
