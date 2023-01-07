<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $surname
 * @property int|null $mobile_no
 * @property string $home_address
 * @property \Cake\I18n\FrozenTime $created_date
 * @property \Cake\I18n\FrozenTime $modified_date
 * @property \Cake\I18n\FrozenTime|null $last_login
 * @property string|null $role
 *
 * @property \App\Model\Entity\Client[] $clients
 * @property \App\Model\Entity\Clinician[] $clinicians
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
        'first_name' => true,
        'surname' => true,
        'mobile_no' => true,
        'home_address' => true,
        'created_date' => true,
        'modified_date' => true,
        'last_login' => true,
        'role' => true,
        'clients' => true,
        'clinicians' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }

    protected function _getFullName()
    {
        return
        $this->first_name.
        ' '.
        $this->surname;
    }
    public function validationHardened(Validator $validator): Validator
    {
        $validator = $this->validationDefault($validator);

        $validator->add('password', 'length', ['rule' => ['lengthBetween', 8, 100]]);
        return $validator;
    }

    protected $_virtual = ['full_name'];

}
