<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property string $article_title
 * @property string|null $article_img
 * @property string $article_desc
 * @property string $article_detail
 * @property \Cake\I18n\FrozenTime $created_date
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Article extends Entity
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
        'article_title' => true,
        'article_img' => true,
        'article_desc' => true,
        'article_detail' => true,
        'created_date' => true,
        'user_id' => true,
        'user' => true,
    ];
}
