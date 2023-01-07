<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\FoodIntake;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * FoodIntake policy
 */
class FoodIntakePolicy
{
    /**
     * Check if $user can create FoodIntake
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FoodIntake $foodIntake
     * @return bool
     */
    public function canCreate(IdentityInterface $user, FoodIntake $foodIntake)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, FoodIntake $foodIntake)
    {
        return true;
    }


    /**
     * Check if $user can update FoodIntake
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FoodIntake $foodIntake
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, FoodIntake $foodIntake)
    {
        return $this->isUser($user, $foodIntake);
    }
    public function canEdit(IdentityInterface $user, FoodIntake $foodIntake)
    {
        return $this->isUser($user, $foodIntake);
    }


    /**
     * Check if $user can delete FoodIntake
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FoodIntake $foodIntake
     * @return bool
     */
    public function canDelete(IdentityInterface $user, FoodIntake $foodIntake)
    {
        return true;
        //return $this->isUser($user, $foodIntake);
    }

    /**
     * Check if $user can view FoodIntake
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FoodIntake $foodIntake
     * @return bool
     */
    public function canView(IdentityInterface $user, FoodIntake $foodIntake)
    {
        return true;
    }

    protected function isUser(IdentityInterface $user, FoodIntake $foodIntake): bool
    {
        $itemQuery = TableRegistry::getTableLocator()->get('FoodIntakes');
        if($itemQuery == null) {
            $clientId = $itemQuery->find()->select(['client_id'])->where(['id' => $foodIntake->id])->firstOrFail()->client_id;

            $clientQuery = TableRegistry::getTableLocator()->get('Clients');
            $userId = $clientQuery->find()->select(['user_id'])->where(['id' => $clientId])->firstOrFail()->user_id;

            return $userId === $user->getIdentifier();
        }
        return false;
    }

    protected function isAdmin(IdentityInterface $user): bool
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1'; //User role is admin
    }
}
