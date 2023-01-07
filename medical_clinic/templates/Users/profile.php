<?php
/**
 * @var AppView $this
 * @var User[]|CollectionInterface $users
 */

use App\Model\Entity\User;
use App\View\AppView;
use Cake\Collection\CollectionInterface;
use Cake\ORM\TableRegistry;

echo $this->Html->css('secondaryTable.css');
echo $this->Html->css('monashHealth-styles.css');
?>

<head>
    <meta name="viewport" content="width=device-width"/>
</head>


<div class="users index content">

    <h3><?= __('My profile') ?></h3>
    <br>

    <?php if ($this->Identity->get('role') === '3') {
    ?>

    <div class="column-responsive column-80">
        <div style="float: none; display: block;">
            <div class="linksDiv" style="text-align: center; padding: 10px">
                <?php
                $userQuery = TableRegistry::getTableLocator()->get('Users');
                $userInfo= $userQuery->find()->select([])->where(['id' => $this->Identity->get('id')])->first();

                echo $this->Html->link(__('Edit General Information'),
                    ['controller' => 'Users', 'action' => 'modify',
                        $this->Identity->get('id')],
                        ['class' => 'button btn-sm']);

                $userRole = $this->Identity->get('role');
                $clientQuery = TableRegistry::getTableLocator()->get('Clients');
                $clientExists = $clientQuery->find()->select([])->where(['id' => $this->Identity->get('id')])->first();
                if ($clientExists == null) {
                    echo $this->Html->link(__('Add Role-dependent Information'), ['controller' => 'Clients', 'action' => 'add'], ['class' => 'button btn-sm']);
                } else {
                    echo $this->Html->link(__('Edit Role-dependent Information'), ['controller' => 'Clients', 'action' => 'selfedit', $clientExists->id], ['class' => 'button btn-sm']);
                } ?>
            </div>
        </div>

        <table>
            <tr>
                <th><?= __('Full Name') ?></th>
                <td><?= $userInfo->first_name.' '.$userInfo->surname ?></td>
            </tr>
            <tr>
                <th><?= __('Role') ?></th>
                <td>
                    <?php
                    if ($this->Identity->get('role') == '1') {
                        echo "Managerial Clinician";
                    } else if ($this->Identity->get('role') == '2') {
                        echo "Clinician";
                    } else if ($this->Identity->get('role') == '3') {
                        echo "Client";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th><?= __('Email') ?></th>
                <td><?=$userInfo->email?></td>
            </tr>
            <tr>
                <th><?= __('Home Address') ?></th>
                <td><?=$userInfo->home_address?></td>
            </tr>
            <tr>
                <th><?= __('Mobile Number') ?></th>
                <td><?=$userInfo->mobile_no?></td>
            </tr>
            <tr>
                <th>Created Date</th>
                <td><?= h($this->Identity->get('created_date')) ?></td>
            </tr>

            <?php
            $clientQuery = TableRegistry::getTableLocator()->get('clients');
            $clientInfos = $clientQuery->find()->select([])->where(['user_id' => $this->Identity->get('id')])->first();

            if ($clientInfos != null) {

            ?>

            <tr>
                <th>Diabetes Type</th>
                <td>
                    <?= $clientInfos->diabetes_type; ?>
                </td>

            </tr>
            <tr>
                <th>Past Births</th>
                <td>
                    <?= $clientInfos->past_births; ?>
                </td>
            </tr>
            <tr>
                <th>Medicare Number</th>
                <td>
                    <?= $clientInfos->medicare_no; ?>
                </td>
            </tr>

            <tr>
                <th>Medical History</th>
                <td>
                    <?= $clientInfos->medical_history; ?>
                </td>
            </tr>
        </table>
        <?php }
        } ?>


        <?php if ($this->Identity->get('role') === '2' || $this->Identity->get('role') === '1') {
            $userQuery = TableRegistry::getTableLocator()->get('Users');
            $userInfo= $userQuery->find()->select([])->where(['id' => $this->Identity->get('id')])->first();

            ?>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><h4><b>Profile</b></h4></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=
                        <?= $this->Url->build(['controller' => 'ClinicianQualifications', 'action' => 'index']); ?>>
                        <h4>Qualifications</h4></a>
                </li>
            </ul>

            <div style="float: none; display: block;">
                <div class="linksDiv" style="text-align: center; padding: 10px">
                    <?= $this->Html->link(__('Edit General Info'), ['controller' => 'Users', 'action' => 'modify', $this->Identity->get('id')], ['class' => 'button btn-sm']) ?>

                    <?php
                    $userRole = $this->Identity->get('role');
                    $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
                    $clinicianExists = $clinicianQuery->find()->select([])->where(['user_id' => $this->Identity->get('id')])->first();
                    if ($clinicianExists == null) {
                        ?>
                        <?= $this->Html->link(__('Add Role-dependent Info'), ['controller' => 'Clinicians', 'action' => 'add'], ['class' => 'button btn-sm']) ?>
                    <?php } else {
                        ?>
                        <?= $this->Html->link(__('Edit Role-dependent Info'), ['controller' => 'Clinicians', 'action' => 'selfedit', $clinicianExists->id], ['class' => 'button btn-sm']) ?>
                        <?php
                    }
                    ?>
                </div>
            </div>


            <div class="column-responsive column-80">
            <table>
            <tr>
                <th><?= __('Full Name') ?></th>
                <td><?= $userInfo->first_name.' '.$userInfo->surname ?></td>
            </tr>
            <tr>
                <th><?= __('Role') ?></th>
                <td>
                    <?php
                    if ($this->Identity->get('role') == '1') {
                        echo "Managerial Clinician";
                    } else if ($this->Identity->get('role') == '2') {
                        echo "Clinician";
                    } else if ($this->Identity->get('role') == '3') {
                        echo "Client";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th><?= __('Email') ?></th>
                <td><?=$userInfo->email?></td>
            </tr>
            <tr>
                <th><?= __('Home Address') ?></th>
                <td><?=$userInfo->home_address?></td>
            </tr>
            <tr>
                <th><?= __('Mobile Number') ?></th>
                <td><?=$userInfo->mobile_no?></td>
            </tr>
            <tr>
                <th>Created Date</th>
                <td><?= h($this->Identity->get('created_date')) ?></td>
            </tr>

            <?php
            $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
            $clinicianInfos = $clinicianQuery->find()->select([])->where(['user_id' => $this->Identity->get('id')])->first();

            if ($clinicianInfos != null) {
                ?>

                <tr>
                    <th>Medical Specialty</th>
                    <td>
                        <?= $clinicianInfos->medical_specialty; ?>
                    </td>
                </tr>

                </table>
                </div>
            <?php }
        }
        ?>
