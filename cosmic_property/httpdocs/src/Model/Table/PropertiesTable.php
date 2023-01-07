<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Properties Model
 *
 * @property \App\Model\Table\InvitedTable&\Cake\ORM\Association\HasMany $Invited
 * @property \App\Model\Table\ItemFoldersTable&\Cake\ORM\Association\HasMany $ItemFolders
 * @property \App\Model\Table\ItemMaintenancesTable&\Cake\ORM\Association\HasMany $ItemMaintenances
 * @property \App\Model\Table\PropertyImagesTable&\Cake\ORM\Association\HasMany $PropertyImages
 * @property \App\Model\Table\PropertyMultiOwnershipsTable&\Cake\ORM\Association\HasMany $PropertyMultiOwnerships
 * @property \App\Model\Table\SubscriptionsTable&\Cake\ORM\Association\HasMany $Subscriptions
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Property get($primaryKey, $options = [])
 * @method \App\Model\Entity\Property newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Property[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Property|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Property saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Property patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Property[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Property findOrCreate($search, callable $callback = null, $options = [])
 */
class PropertiesTable extends Table
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

        $this->setTable('properties');
        $this->setDisplayField('property_name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Users', [
            'foreignKey' => 'property_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'properties_users',
        ]);

        $this->hasMany('PropertiesUsers', [
            'foreignKey' => 'property_id',
            'dependent' => true
        ]);

        $this->hasMany('Subscriptions', [
            'foreignKey' => 'property_id',
            'dependent' => true, 
        ]);

        $this->hasMany('ItemFolders', [
            'foreignKey' => 'property_id',
            'dependent' => true, 
        ]);
        $this->hasMany('ItemMaintenances', [
            'foreignKey' => 'property_id',
            'dependent' => true, 
        ]);
        $this->hasMany('PropertyImages', [
            'foreignKey' => 'property_id',
            'dependent' => true, 
        ]);
        $this->hasMany('PropertyMultiOwnerships', [
            'foreignKey' => 'property_id',
        ]);
        $this->hasMany('Invited', [
            'foreignKey' => 'property_id',
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
            ->notEmptyString('id', null, 'create');

        $validator
            ->scalar('property_name')
            ->maxLength('property_name', 50,'Maximum name of the building is 50 words')
            ->requirePresence('property_name', 'create')
            ->notEmptyString('property_name','Property name can not be empty');


        $validator
            ->scalar('property_des')
            ->maxLength('property_des', 255,'Maximum description allowed is 255 characters')
            ->allowEmptyString('property_des');

        $validator
            ->integer('street_number','Street number has to be an integer')
            ->requirePresence('street_number', 'create')
            ->notEmptyString('street_number','Street number can not be empty');

        $validator
            ->scalar('street_name')
            ->maxLength('street_name', 50)
            ->requirePresence('street_name', 'create','Maximum length of street name is 50 characters')
            ->notEmptyString('street_name','Street name can not be empty');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 10,'Maximum length of postcode is 10 numbers')
            ->requirePresence('postcode', 'create')
            ->notEmptyString('postcode','Postcode can not be empty');

        $validator
            ->scalar('city')
            ->maxLength('city', 100,'Maximum length of city is 100 character')
            ->requirePresence('city', 'create')
            ->notEmptyString('city','City/suburb can not be empty');

        $validator
            ->scalar('state')
            ->maxLength('state', 20,'Maximum length for state is 20 characters')
            ->requirePresence('state', 'create')
            ->notEmptyString('state','State can not be empty');

        $validator
            ->scalar('country')
            ->maxLength('country', 20,'Maximum length of country is 20 characters')
            ->requirePresence('country', 'create')
            ->notEmptyString('country','Country can not be empty');

        $validator
            ->scalar('building_type')
            ->maxLength('building_type', 50)
            ->requirePresence('building_type', 'create')
            ->notEmptyString('building_type','Building type can not be empty');

        $validator
            ->scalar('ownership_type')
            ->maxLength('ownership_type', 50)
            ->requirePresence('ownership_type', 'create')
            ->notEmptyString('ownership_type','Ownership type can not be empty');

        $validator
            ->date('property_date')
            ->allowEmptyDate('property_date');
            
        $validator
            ->date('maintenance_inspection_date')
            ->allowEmptyDate('maintenance_inspection_date');

        $validator
            ->integer('year_built','Year built has to be integer')
            ->allowEmptyString('year_built');

        $validator
            ->integer('age','Age has to be integer')
            ->allowEmptyString('age');

        $validator
            ->scalar('plan_of_subdivision_number')
            ->maxLength('plan_of_subdivision_number', 20)
            ->allowEmptyString('plan_of_subdivision_number');

        $validator
            ->scalar('starting_balance')
            ->maxLength('starting_balance', 255)
            ->allowEmptyString('starting_balance');

        $validator
            ->scalar('contribution_safety_net')
            ->maxLength('contribution_safety_net', 255)
            ->allowEmptyString('contribution_safety_net');

        $validator
            ->scalar('interest_rate')
            ->maxLength('interest_rate', 255)
            ->allowEmptyString('interest_rate');

        $validator
            ->scalar('inflation_rate')
            ->maxLength('inflation_rate', 255)
            ->allowEmptyString('inflation_rate');

        $validator
            ->scalar('GST_Status')
            ->maxLength('GST_Status', 255)
            ->allowEmptyString('GST_Status');

        $validator
            ->scalar('GST')
            ->maxLength('GST', 255)
            ->allowEmptyString('GST');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->notEmptyString('status');

        $validator
            ->scalar('finalized')
            ->maxLength('finalized', 255)
            ->notEmptyString('finalized');
        $validator
            ->scalar('base_contribution_percentage')
            ->maxLength('base_contribution_percentage', 255)
            ->allowEmptyString('base_contribution_percentage');

        $validator
            ->scalar('tax_rate')
            ->maxLength('tax_rate', 255)
            ->allowEmptyString('tax_rate');



        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    //    public function buildRules(RulesChecker $rules)
    //    {
    //        $rules->add($rules->existsIn(['user_id'], 'Users'));
    //
    //        return $rules;
    //    }
}
