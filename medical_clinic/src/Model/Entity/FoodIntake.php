<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FoodIntake Entity
 *
 * @property int $id
 * @property int $client_id
 * @property string $food_eaten
 * @property \Cake\I18n\FrozenTime $logged_time
 *
 * @property \App\Model\Entity\Client $client
 */
class FoodIntake extends Entity
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
        'client_id' => true,
        'food_eaten' => true,
        'logged_time' => true,
        'client' => true,
    ];
}
