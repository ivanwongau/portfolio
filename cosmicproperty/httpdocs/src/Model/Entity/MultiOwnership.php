<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MultiOwnership Entity
 *
 * @property int $id
 * @property string|null $owner_corporation_number
 * @property int $number_lot
 * @property int $number_lot_liability
 * @property int $building_id
 *
 * @property \App\Model\Entity\Building $building
 */
class MultiOwnership extends Entity
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
        'owner_corporation_number' => true,
        'number_lot' => true,
        'number_lot_liability' => true,
        'building_id' => true,
        'building' => true,
    ];
}
