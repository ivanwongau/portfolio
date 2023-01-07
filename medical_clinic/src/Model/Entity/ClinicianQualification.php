<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClinicianQualification Entity
 *
 * @property int $id
 * @property string $qualification
 * @property \Cake\I18n\FrozenTime $date_expire
 * @property int $clinician_id
 *
 * @property \App\Model\Entity\Clinician $clinician
 */
class ClinicianQualification extends Entity
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
        'qualification' => true,
        'date_expire' => true,
        'clinician_id' => true,
        'clinician' => true,
    ];
}
