<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DashboardRename Entity
 *
 * @property int $id
 * @property string $name
 * @property string $System_Configured_Name
 * @property string $location
 * @property string $Description
 */
class DashboardRename extends Entity
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
        'name' => true,
        'System_Configured_Name' => true,
        'location' => true,
        'Description' => true,
    ];
}
