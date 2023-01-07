<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Goal Entity
 *
 * @property int $id
 * @property int $client_id
 * @property string $goals_set
 * @property \Cake\I18n\FrozenTime $completion_date
 *
 * @property \App\Model\Entity\Client $client
 */
class Goal extends Entity
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
        'goals_set' => true,
        'completion_date' => true,
        'client' => true,
    ];
}
