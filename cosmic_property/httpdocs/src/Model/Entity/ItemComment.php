<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemComment Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $create_date
 * @property string|null $content
 * @property int $item_maintenance_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\ItemMaintenance $item_maintenance
 * @property \App\Model\Entity\User $user
 */
class ItemComment extends Entity
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
        'create_date' => true,
        'content' => true,
        'item_maintenance_id' => true,
        'user_id' => true,
        'item_maintenance' => true,
        'user' => true,
    ];
}
