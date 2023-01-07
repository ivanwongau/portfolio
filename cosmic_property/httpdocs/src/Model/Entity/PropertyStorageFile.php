<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PropertyStorageFile Entity
 *
 * @property int $id
 * @property string $file_name
 * @property int $uploaded_by
 * @property \Cake\I18n\FrozenDate|null $uploaded_date
 * @property string|null $file_details
 * @property int $folder_id
 * @property string $file_path
 *
 * @property \App\Model\Entity\PropertyStorageFolder $property_storage_folder
 */
class PropertyStorageFile extends Entity
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
        'file_name' => true,
        'uploaded_by' => true,
        'uploaded_date' => true,
        'file_details' => true,
        'folder_id' => true,
        'file_path' => true,
        'property_storage_folder' => true,
    ];
}
