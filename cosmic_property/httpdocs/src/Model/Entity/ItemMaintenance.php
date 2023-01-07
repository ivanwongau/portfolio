<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemMaintenance Entity
 *
 * @property int $id
 * @property string $item_name
 * @property int $property_id
 * @property string $item_status
 * @property string $item_location
 * @property string $item_finding
 * @property string $item_recommendation
 * @property string $cost_estimate
 * @property string $potential_hazard
 * @property string $item_priority
 *
 * @property \App\Model\Entity\Property $property
 */
class ItemMaintenance extends Entity
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
        'item_name' => true,
        'property_id' => true,
        'item_status' => true,
        'item_location' => true,
        'item_finding' => true,
        'item_recommendation' => true,
        'cost_estimate' => true,
        'potential_hazard' => true,
        'item_priority' => true,
        'property' => true,
    ];
}
