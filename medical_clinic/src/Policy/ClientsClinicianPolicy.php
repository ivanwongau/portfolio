<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Client;
use App\Model\Entity\ClientsClinician;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * ClientsClinician policy
 */
class ClientsClinicianPolicy
{
    /**
     * Check if $user can create ClientsClinician
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClientsClinician $clientsClinician
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ClientsClinician $clientsClinician)
    {
        return  true;
    }

    public function canAdd(IdentityInterface $user, ClientsClinician $clientsClinician)
    {
        return  true;
    }

    /**
     * Check if $user can update ClientsClinician
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClientsClinician $clientsClinician
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ClientsClinician $clientsClinician)
    {
        return  $this->isAdmin($user);
    }
    public function canEdit(IdentityInterface $user, ClientsClinician $clientsClinician)
    {
        return  $this->isAdmin($user);
    }


    /**
     * Check if $user can delete ClientsClinician
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClientsClinician $clientsClinician
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ClientsClinician $clientsClinician)
    {
        return  $this->isAdmin($user);
    }

    /**
     * Check if $user can view ClientsClinician
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ClientsClinician $clientsClinician
     * @return bool
     */
    public function canView(IdentityInterface $user, ClientsClinician $clientsClinician)
    {
        return true;
    }

    protected function isAdmin(IdentityInterface $user): bool
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1'; //User role is admin
    }
}
