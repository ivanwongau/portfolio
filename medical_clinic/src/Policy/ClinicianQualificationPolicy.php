<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ClinicianQualification;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * ClinicianQualification policy
 */
class ClinicianQualificationPolicy
{
    /**
     * Check if $user can create ClinicianQualification
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClinicianQualification $clinicianQualification
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ClinicianQualification $clinicianQualification)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, ClinicianQualification $clinicianQualification)
    {
        return true;
    }


    /**
     * Check if $user can update ClinicianQualification
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClinicianQualification $clinicianQualification
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ClinicianQualification $clinicianQualification)
    {
        return $this->isUser($user, $clinicianQualification);
    }
    public function canEdit(IdentityInterface $user, ClinicianQualification $clinicianQualification)
    {
        return $this->isUser($user, $clinicianQualification) || $this->isAdmin($user) || $this->isClinician($user);
    }

    /**
     * Check if $user can delete ClinicianQualification
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClinicianQualification $clinicianQualification
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ClinicianQualification $clinicianQualification)
    {
        return $this->isUser($user, $clinicianQualification) || $this->isAdmin($user);
    }

    /**
     * Check if $user can view ClinicianQualification
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClinicianQualification $clinicianQualification
     * @return bool
     */
    public function canView(IdentityInterface $user, ClinicianQualification $clinicianQualification)
    {
        return $this->isAdmin($user);
    }

    protected function isUser(IdentityInterface $user, ClinicianQualification $clinicianQualification): bool
    {
        $itemQuery = TableRegistry::getTableLocator()->get('ClinicianQualifications');
        $clinicianId = $itemQuery->find()->select(['clinician_id'])->where(['id' => $clinicianQualification->id])->firstOrFail()->clinician_id;

        $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
        $userId = $clinicianQuery->find()->select(['user_id'])->where(['id' => $clinicianId])->firstOrFail()->user_id;

        return $userId === $user->getIdentifier();
    }

    protected function isAdmin(IdentityInterface $user): bool
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1'; //User role is admin
    }
}
