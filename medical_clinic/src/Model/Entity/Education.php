<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Education Entity
 *
 * @property int $id
 * @property string $video_title
 * @property string $video_desc
 * @property string|null $video_img
 * @property string $video_url
 * @property \Cake\I18n\FrozenTime $created_date
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Education extends Entity
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
        'video_title' => true,
        'video_desc' => true,
        'video_img' => true,
        'video_url' => true,
        'created_date' => true,
        'user_id' => true,
        'user' => true,
    ];
}
