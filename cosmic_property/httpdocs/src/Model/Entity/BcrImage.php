<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BcrImage Entity
 *
 * @property int $id
 * @property string $image_path
 * @property string $image_name
 * @property int $item_id
 *
 * @property \App\Model\Entity\Item $item
 */
class BcrImage extends Entity
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
        'image_path' => true,
        'image_name' => true,
        'item_id' => true,
        'item' => true,
    ];
}
