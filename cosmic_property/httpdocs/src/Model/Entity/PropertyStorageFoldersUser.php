<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PropertyStorageFoldersUser Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $property_storage_folder_id
 * @property int $folder_access_level
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\PropertyStorageFolder $property_storage_folder
 */
class PropertyStorageFoldersUser extends Entity
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
        'user_id' => true,
        'property_storage_folder_id' => true,
        'folder_access_level' => true,
        'user' => true,
        'property_storage_folder' => true,
    ];
}
