<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Clinician Entity
 *
 * @property int $id
 * @property string|null $medical_specialty
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ClinicianQualification[] $clinician_qualifications
 * @property \App\Model\Entity\Client[] $clients
 */
class Clinician extends Entity
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
        'medical_specialty' => true,
        'user_id' => true,
        'user' => true,
        'clinician_qualifications' => true,
        'clients' => true,
    ];

    protected function _getFullName()
    {
        // Check if clinician has a user counterpart
        $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
        // If they do, return full name
        if($this->user_id && $this->id != 0){
            $currentUserId = $clinicianQuery->find()->select(['user_id'])->where(['id' => $this->id])->first()->user_id;

            $userQuery = TableRegistry::getTableLocator()->get('Users');
            $user = $userQuery->find()->select(['first_name', 'surname'])->where(['id' => $currentUserId])->first();

            if($user != null){
                return
                    $user->first_name.
                    ' '.
                    $user->surname;
            }
        }
        // If not, just return user id
        return $this->id;
    }

    protected $_virtual = ['full_name'];


}
