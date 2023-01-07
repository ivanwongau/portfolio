<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can create User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canCreate(IdentityInterface $user, User $resource)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, User $resource)
    {
         
        return true;
    }


    /**
     * Check if $user can update User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, User $resource)
    {
        return $this->isUser($user, $resource) || $this->isAdmin($user);
    }

    public function canEdit(IdentityInterface $user, User $resource)
    {
        return $this->isUser($user, $resource) || $this->isAdmin($user);
    }

    /**
     * Check if $user can delete User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        $isAnAdmin = $this->isAdmin($user);

        if($isAnAdmin){
            return true;
        }

        return false;
    }

    /**
     * Check if $user can view User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return true;
    }

    public function canLogin(IdentityInterface  $user, User $resource){
        $query = TableRegistry::getTableLocator()->get('Users')->query();
        $query->update()
            ->set(['last_login' => date('Y-m-d H:i:s')])
            ->where(['id' => $user->getIdentifier()])
            ->execute();

        return true;
    }

    protected function isUser(IdentityInterface $user, User $resource)
    {
        return $resource->user_id === $user->getIdentifier();
    }

    protected function isAdmin(IdentityInterface $user)
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1'; //User role is admin
    }
}
