<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PropertyStorageFolder Entity
 *
 * @property int $id
 * @property string $folder_name
 * @property int $property_id
 *
 * @property \App\Model\Entity\Property $property
 */
class PropertyStorageFolder extends Entity
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
        'folder_name' => true,
        'property_id' => true,
        'property' => true,
    ];
}
