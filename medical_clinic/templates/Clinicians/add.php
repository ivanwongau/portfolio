<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinician $clinician
 */

use Cake\ORM\TableRegistry;

echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');
?>

    <?php if($this->Identity->get('role') === '2') {
    ?>
    <div class="column-responsive column-80">
        <div class="clinicians form content">
            <?= $this->Form->create($clinician) ?>
            <fieldset>
                <legend><?= __('Add Clinician') ?></legend>
                <?php
                    echo $this->Form->control('medical_specialty');
                    echo $this->Form->control('user_id', ['default' => $this->Identity->get('id'), 'label' => '', 'hidden' => 'true']);
                    echo $this->Form->control('clients._ids', ['options' => $clients, 'label' => '', 'hidden' => 'true']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <?php } ?>

    <?php if($this->Identity->get('role') === '1') { ?>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link add active" aria-current="page" href=
                    <?= $this->Url->build(['controller' => 'Clinicians', 'action' => 'add']); ?>>
                    <h4><b>Add</b></h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=
                    <?= $this->Url->build(['controller' => 'Clinicians', 'action' => 'index']); ?>>
                    <h4>Return to List</h4></a>
            </li>
        </ul>


        <?php
        // Get users who are of clinician role AND do not have an existing client profile.
        $usersQuery = TableRegistry::getTableLocator()->get('Users');
        $cliniciansQuery = TableRegistry::getTableLocator()->get('Clinicians');

        $users = $usersQuery->find()->select([])->all();

        $unregisteredClinicians = [];
        foreach ($users as $user) {
            // If user was assigned a role of '1' or '2' aka managerial clinician or clinician on creation.
            if ($user->role == '1' || $user->role == '2' ) {
                // If user does not have an existing profile.
                $clientRoleUser = $cliniciansQuery->find()->select([])->where(['user_id' => $user->id])->first();
                if ($clientRoleUser == null) {
                    $unregisteredClinicians[$user->id] = $user->first_name . ' ' . $user->surname;
                }
            }
        }


        ?>
        <div class="column-responsive column-80">
            <div class="clinicians form content">
                <?= $this->Form->create($clinician) ?>
                <fieldset>
                    <legend><?= __('Add Clinician') ?></legend>
                    <?php
                    echo $this->Form->control('medical_specialty');
                    echo $this->Form->control('user_id', ['options' => $unregisteredClinicians]);
                    echo $this->Form->control('clients._ids', ['options' => $clients, 'label' => '', 'hidden' => 'true']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    <?php } ?>

</div>
