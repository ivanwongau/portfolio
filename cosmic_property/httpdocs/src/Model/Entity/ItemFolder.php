<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemFolder Entity
 *
 * @property int $id
 * @property int $property_id
 * @property string $folder_name
 *
 * @property \App\Model\Entity\Property $property
 */
class ItemFolder extends Entity
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
        'property_id' => true,
        'folder_name' => true,
        'property' => true,
    ];
}
