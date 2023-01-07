<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Enquiry Entity
 *
 * @property int $id
 * @property string $name
 * @property string $temp_email
 * @property string $topic
 * @property string $message
 * @property \Cake\I18n\FrozenTime $date
 * @property string $status
 * @property int|null $user_id
 */
class Enquiry extends Entity
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
        'name' => true,
        'temp_email' => true,
        'topic' => true,
        'message' => true,
        'date' => true,
        'status' => true,
        'user_id' => true,
    ];
}
