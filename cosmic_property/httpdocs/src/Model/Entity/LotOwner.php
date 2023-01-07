<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LotOwner Entity
 *
 * @property int $id
 * @property string $lots_no
 * @property string $no_liabilities
 * @property int $ownership_id
 *
 * @property \App\Model\Entity\PropertyMultiOwnership $property_multi_ownership
 */
class LotOwner extends Entity
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
        'lots_no' => true,
        'no_liabilities' => true,
        'ownership_id' => true,
        'property_multi_ownership' => true,
    ];
}
