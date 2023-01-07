<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Clinician;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * Clinician policy
 */
class ClinicianPolicy
{
    /**
     * Check if $user can create Clinician
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Clinician $clinician
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Clinician $clinician)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, Clinician $clinician)
    {
        return true;
    }


    /**
     * Check if $user can update Clinician
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Clinician $clinician
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Clinician $clinician)
    {
        return $this->isUser($user, $clinician);
    }

    public function canEdit(IdentityInterface $user, Clinician $clinician)
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $this->isUser($user, $clinician) || $userRole === '1';
    }

    public function canSelfedit(IdentityInterface $user, Clinician $clinician)
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $this->isUser($user, $clinician) || $userRole === '1';
    }

    /**
     * Check if $user can delete Clinician
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Clinician $clinician
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Clinician $clinician)
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1';
    }

    /**
     * Check if $user can view Clinician
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Clinician $clinician
     * @return bool
     */
    public function canView(IdentityInterface $user, Clinician $clinician)
    {
        return true;
    }

    protected function isUser(IdentityInterface $user, Clinician $clinician)
    {
        $itemQuery = TableRegistry::getTableLocator()->get('Clinicians');
        $userId = $itemQuery->find()->select(['user_id'])->where(['id' => $clinician->id])->firstOrFail()->user_id;

        return $userId === $user->getIdentifier();

        return $clinician->user_id === $user->getIdentifier();
    }

}
