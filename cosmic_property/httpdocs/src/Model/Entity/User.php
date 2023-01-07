<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $verified
 * @property string $token
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string|null $company_name
 * @property string|null $company_street
 * @property string|null $company_city
 * @property string|null $company_state
 * @property int|null $company_postcode
 * @property string|null $company_country
 * @property string $role
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'verified' => true,
        'token' => true,
        'first_name' => true,
        'last_name' => true,
        'phone' => true,
        'company_name' => true,
        'company_street' => true,
        'company_city' => true,
        'company_state' => true,
        'company_postcode' => true,
        'company_country' => true,
        'role' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token',
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
