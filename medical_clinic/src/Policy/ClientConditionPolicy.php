<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ClientCondition;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * ClientCondition policy
 */
class ClientConditionPolicy
{
    /**
     * Check if $user can create ClientCondition
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClientCondition $clientCondition
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ClientCondition $clientCondition)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, ClientCondition $clientCondition)
    {
        return true;
    }

    /**
     * Check if $user can update ClientCondition
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClientCondition $clientCondition
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ClientCondition $clientCondition)
    {
        return $this->isUser($user, $clientCondition) || $this->isAdmin($user) || $this->isClinician($user);
    }

    public function canEdit(IdentityInterface $user, ClientCondition $clientCondition)
    {
        return $this->isUser($user, $clientCondition) || $this->isAdmin($user) || $this->isClinician($user);
    }

    /**
     * Check if $user can delete ClientCondition
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClientCondition $clientCondition
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ClientCondition $clientCondition)
    {
        return $this->isUser($user, $clientCondition) || $this->isAdmin($user);
    }

    /**
     * Check if $user can view ClientCondition
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClientCondition $clientCondition
     * @return bool
     */
    public function canView(IdentityInterface $user, ClientCondition $clientCondition)
    {
        return $this->isUser($user, $clientCondition) || $this->isAdmin($user) || $this->isClinician($user);
    }

    protected function isUser(IdentityInterface $user, ClientCondition $clientCondition)
    {
        $itemQuery = TableRegistry::getTableLocator()->get('ClientConditions');
        $clientId = $itemQuery->find()->select(['client_id'])->where(['id' => $clientCondition->id])->firstOrFail()->client_id;

        $clientQuery = TableRegistry::getTableLocator()->get('Clients');
        $userId = $clientQuery->find()->select(['user_id'])->where(['id' => $clientId])->firstOrFail()->user_id;

        return $userId === $user->getIdentifier();
    }

    protected function isAdmin(IdentityInterface $user): bool
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1'; //User role is admin
    }

    protected function isClinician(IdentityInterface $user): bool
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '2'; //User role is clinician
    }

}
