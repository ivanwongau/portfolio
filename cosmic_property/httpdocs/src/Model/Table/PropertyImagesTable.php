<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PropertyImages Model
 *
 * @property \App\Model\Table\PropertiesTable&\Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\PropertyImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\PropertyImage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PropertyImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PropertyImage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyImage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyImage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyImage findOrCreate($search, callable $callback = null, $options = [])
 */
class PropertyImagesTable extends Table
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

        $this->setTable('property_images');
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
            ->scalar('image_name')
            ->maxLength('image_name', 255)
            ->requirePresence('image_name', 'create')
            ->notEmptyFile('image_name');

        $validator
            ->scalar('image_path')
            ->maxLength('image_path', 8000)
            ->requirePresence('image_path', 'create')
            ->notEmptyFile('image_path');

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
