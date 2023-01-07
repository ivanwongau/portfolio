<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscription Entity
 *
 * @property int $id
 * @property int $property_id
 * @property \Cake\I18n\FrozenDate $commencement_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property int $period
 * @property int $forecast_period_display
 * @property int $forecast_in_advance
 *
 * @property \App\Model\Entity\Building $building
 */
class Subscription extends Entity
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
        'property_id' => true,
        'commencement_date' => true,
        'end_date' => true,
        'period' => true,
        'forecast_period_display' => true,
        'forecast_in_advance' => true,
        'building' => true,
    ];
}
