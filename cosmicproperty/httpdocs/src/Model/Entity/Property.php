<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Property Entity
 *
 * @property int $id
 * @property string $property_name
 * @property string|null $property_des
 * @property int $street_number
 * @property string $street_name
 * @property string $postcode
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $building_type
 * @property string $ownership_type
 * @property \Cake\I18n\FrozenDate|null $property_date
 * @property int $year_built
 * @property int|null $age
 * @property string $plan_of_subdivision_number
 * @property string|null $starting_balance
 * @property string|null $contribution_safety_net
 * @property string|null $interest_rate
 * @property string|null $inflation_rate
 * @property string|null $GST_Status
 * @property string|null $GST
 * @property string $status
 * @property string $finalized
 * @property string|null $base_contribution_percentage
 * @property string|null $tax_rate
 * @property \Cake\I18n\FrozenDate|null $maintenance_inspection_date
 *
 * @property \App\Model\Entity\Invited[] $invited
 * @property \App\Model\Entity\ItemFolder[] $item_folders
 * @property \App\Model\Entity\ItemMaintenance[] $item_maintenances
 * @property \App\Model\Entity\PropertyImage[] $property_images
 * @property \App\Model\Entity\PropertyMultiOwnership[] $property_multi_ownerships
 * @property \App\Model\Entity\Subscription[] $subscriptions
 * @property \App\Model\Entity\User[] $users
 */
class Property extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'property_name' => true,
        'property_des' => true,
        'street_number' => true,
        'street_name' => true,
        'postcode' => true,
        'city' => true,
        'state' => true,
        'country' => true,
        'building_type' => true,
        'ownership_type' => true,
        'property_date' => true,
        'year_built' => true,
        'age' => true,
        'plan_of_subdivision_number' => true,
        'starting_balance' => true,
        'contribution_safety_net' => true,
        'interest_rate' => true,
        'inflation_rate' => true,
        'GST_Status' => true,
        'GST' => true,
        'status' => true,
        'finalized' => true,
        'base_contribution_percentage'=>true,
        'tax_rate' => true,
        'maintenance_inspection_date' => true,




        'invited' => true,
        'item_folders' => true,
        'item_maintenances' => true,
        'property_images' => true,
        'property_multi_ownerships' => true,
        'subscriptions' => true,
        'users' => true,
    ];
}
