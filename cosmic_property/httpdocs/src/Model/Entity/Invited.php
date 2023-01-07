<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invited Entity
 *
 * @property int $id
 * @property string $email
 * @property int $property_id
 * @property int $access_level
 *
 * @property \App\Model\Entity\Property $property
 */
class Invited extends Entity
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
        'email' => true,
        'property_id' => true,
        'access_level' => true,
        'property' => true,
    ];
}
