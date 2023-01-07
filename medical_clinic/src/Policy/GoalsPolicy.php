<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Goal;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * goals policy
 */
class goalsPolicy
{
    /**
     * Check if $user can add goals
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Goal $goals
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Goal $goals)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, Goal $goals)
    {
        return true;
    }

    /**
     * Check if $user can edit goals
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Goal $goals
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Goal $goals)
    {
        return $this->isUser($user, $goals);
    }

    public function canEdit(IdentityInterface $user, Goal $goals)
    {
        return true;
    }

    /**
     * Check if $user can delete goals
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Goal $goals
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Goal $goals)
    {
        return true;
    }

    /**
     * Check if $user can view goals
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Goal $goals
     * @return bool
     */
    public function canView(IdentityInterface $user, Goal $goals)
    {
        return true;
    }

    protected function isUser(IdentityInterface $user, Goal $goals)
    {
        $itemQuery = TableRegistry::getTableLocator()->get('Goals');
        if($itemQuery == null) {
            $clientId = $itemQuery->find()->select(['client_id'])->where(['id' => $goals->id])->firstOrFail()->client_id;

            $clientQuery = TableRegistry::getTableLocator()->get('Clients');
            $userId = $clientQuery->find()->select(['user_id'])->where(['id' => $clientId])->firstOrFail()->user_id;

            return $userId === $user->getIdentifier();
        }
        return false;
    }
    protected function isAdmin(IdentityInterface $user)
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1'; //User role is admin
    }


}
