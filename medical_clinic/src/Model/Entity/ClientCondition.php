<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClientCondition Entity
 *
 * @property int $id
 * @property string $insulin_level
 * @property float|null $weight
 * @property float|null $BMI
 * @property \Cake\I18n\FrozenTime $logged_time
 * @property int $client_id
 *
 * @property \App\Model\Entity\Client $client
 */
class ClientCondition extends Entity
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
        'insulin_level' => true,
        'weight' => true,
        'BMI' => true,
        'logged_time' => true,
        'client_id' => true,
        'client' => true,
    ];
}
