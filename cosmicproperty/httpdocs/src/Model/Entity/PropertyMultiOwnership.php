<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PropertyMultiOwnership Entity
 *
 * @property int $id
 * @property string|null $owner_corp_num
 * @property int $Num_of_lot
 * @property int $Num_of_lot_liabilities
 * @property \Cake\I18n\FrozenDate|null $plan_registration_date
 * @property string|null $strata_plan_number
 * @property int $property_id
 *
 * @property \App\Model\Entity\Property $property
 */
class PropertyMultiOwnership extends Entity
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
        'owner_corp_num' => true,
        'Num_of_lot' => true,
        'Num_of_lot_liabilities' => true,
        'strata_plan_number' => true,
        'plan_registration_date' => true,
        'property_id' => true,
        'property' => true,
    ];
}
