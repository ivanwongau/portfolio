<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property string|null $item_name
 * @property int|null $item_quantity
 * @property string|null $item_unit_of_mes
 * @property float|null $item_rate
 * @property float|null $item_total
 * @property string|null $item_allowance
 * @property string|null $item_condition
 * @property int|null $year_due
 * @property int|null $expected_life
 * @property int $folder_id
 * @property string $expected_year_due
 *
 * @property \App\Model\Entity\ItemFolder $item_folder
 * @property \App\Model\Entity\BcrImage[] $bcr_images
 * @property \App\Model\Entity\ItemImage[] $item_images
 */
class Item extends Entity
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
        'item_quantity' => true,
        'item_unit_of_mes' => true,
        'item_rate' => true,
        'item_total' => true,
        'item_allowance' => true,
        'item_condition' => true,
        'year_due' => true,
        'expected_life' => true,
        'folder_id' => true,
        'expected_year_due' => true,
        'item_folder' => true,
        'bcr_images' => true,
        'item_images' => true,
    ];
}
