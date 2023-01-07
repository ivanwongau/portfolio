<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $diabetes_type
 * @property int $past_births
 * @property string|null $medicare_no
 * @property int|null $medicare_ref
 * @property string|null $medical_history
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ClientCondition[] $client_conditions
 * @property \App\Model\Entity\FoodIntake[] $food_intakes
 * @property \App\Model\Entity\Clinician[] $clinicians
 */
class Client extends Entity
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
        'diabetes_type' => true,
        'past_births' => true,
        'medicare_no' => true,
        'medicare_ref' => true,
        'medical_history' => true,
        'user_id' => true,
        'user' => true,
        'client_conditions' => true,
        'food_intakes' => true,
        'clinicians' => true,
    ];

    protected function _getFullName()
    {
        // Check if client has a user counterpart.
        $clientQuery = TableRegistry::getTableLocator()->get('Clients');
        // If they do, retrieve the full name.
        if($this->user_id && $this->id != 0){
            $currentUser = $clientQuery->find()->select(['user_id'])->where(['id' => $this->id])->first();

            $currentUserId = $currentUser->user_id;

            $userQuery = TableRegistry::getTableLocator()->get('Users');
            $user = $userQuery->find()->select(['first_name', 'surname'])->where(['id' => $currentUserId])->first();

            if($user != null){
                return
                    $user->first_name.
                    ' '.
                    $user->surname;
            } else {
                return ' ';
            }
        }
        // If not, just retrieve their id.
        return (string)$this->id;
    }

    protected $_virtual = ['full_name'];
}
