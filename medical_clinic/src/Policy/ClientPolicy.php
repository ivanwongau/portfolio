<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Client;
use App\Model\Entity\Clinician;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * Client policy
 */
class ClientPolicy
{
    /**
     * Check if $user can create Client
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Client $client
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Client $client)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, Client $client)
    {
        return true;
    }

    /**
     * Check if $user can update Client
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Client $client
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Client $client)
    {
        return $this->isUser($user, $client) || $this->isAdmin($user);
    }

    public function canEdit(IdentityInterface $user, Client $client)
    {
        return true;
        //return $this->isUser($user, $client) || $this->isAdmin($user);
    }

    public function canSelfedit(IdentityInterface $user, Client $client)
    {
        return $this->isUser($user, $client);
    }

    /**
     * Check if $user can delete Client
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Client $client
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Client $client)
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1';
    }

    /**
     * Check if $user can view Client
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Client $client
     * @return bool
     */

    public function canView(IdentityInterface $user, Client $client)
    {
        return $this->isUser($user, $client) || $this->isAdmin($user) || $this->isClinician($user);
    }

    protected function isUser(IdentityInterface $user, Client $client): bool
    {
        $itemQuery = TableRegistry::getTableLocator()->get('Clients');
        $userId = $itemQuery->find()->select(['user_id'])->where(['id' => $client->id])->firstOrFail()->user_id;

        return $client->user_id === $user->getIdentifier();
    }


    protected function isAdmin(IdentityInterface $user): bool
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '1'; //User role is admin
    }

    protected function isClinician(IdentityInterface $user)
    {
        $userQuery = TableRegistry::getTableLocator()->get('Users');
        $userRole = $userQuery->find()->select(['role'])->where(['id' => $user->getIdentifier()])->firstOrFail()->role;

        return $userRole === '2'; //User role is clinician
    }

}
