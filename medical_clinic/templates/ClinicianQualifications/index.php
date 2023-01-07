<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClinicianQualification[]|\Cake\Collection\CollectionInterface $clinicianQualifications
 */

use Cake\ORM\TableRegistry;
echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');

?>


<?php if($this->Identity->get('role') === '2' || $this->Identity->get('role') === '1' ) {

?>
    <div class="clinicianQualifications index content">
        <h3><strong><?= __('Your Qualifications') ?></strong></h3>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href=<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile', $this->Identity->get('id')]); ?>>
                    <h4>Profile</h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <h4><b>Qualifications</b></h4></a>
            </li>
        </ul>

        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('qualification') ?></th>
                    <th><?= $this->Paginator->sort('date_expire') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($clinicianQualifications as $clinicianQualification):

                    //  Gets the user id of the clinician and matches it with the records
                    $itemQuery = TableRegistry::getTableLocator()->get('ClinicianQualifications');
                    $clinicianId = $itemQuery->find()->select([])->where(['id' => $clinicianQualification->id])->firstOrFail()->clinician_id;

                    $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
                    $userId = $clinicianQuery->find()->select([])->where(['id' => $clinicianId])->firstOrFail()->user_id;

                    $userQuery = TableRegistry::getTableLocator()->get('Users');

                    if($this->Identity->get('id') === $userId){

                        ?>
                        <tr>
                            <td><?= h($clinicianQualification->qualification) ?></td>
                            <td><?= h($clinicianQualification->date_expire) ?></td>
                        </tr>
                        <?php
                    }
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
<?php
    }
?>


<?php if( $this->Identity->get('role') === '3') {
    ?>

    <div class="clinicianQualifications index content">
        <?= $this->Html->link(__('New Clinician Qualification'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <h3><?= __('Clinician Qualifications') ?></h3>
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('qualification') ?></th>
                    <th><?= $this->Paginator->sort('date_expire') ?></th>
                    <th><?= $this->Paginator->sort('clinician_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($clinicianQualifications as $clinicianQualification):

                    //  Gets the user id of the clinician and matches it with the records
                    $itemQuery = TableRegistry::getTableLocator()->get('ClinicianQualifications');
                    $clinicianId = $itemQuery->find()->select([])->where(['id' => $clinicianQualification->id])->firstOrFail()->clinician_id;

                    $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
                    $userId = $clinicianQuery->find()->select([])->where(['id' => $clinicianId])->firstOrFail()->user_id;

                    $userQuery = TableRegistry::getTableLocator()->get('Users');
                    $user = $userQuery->find()->select([])->where(['id' => $userId])->firstOrFail();

                    ?>
                    <tr>
                        <td><?= h($clinicianQualification->qualification) ?></td>
                        <td><?= h($clinicianQualification->date_expire) ?></td>
                        <td><?= $clinicianQualification->has('clinician') ? $this->Html->link($user->first_name.' '.$user->surname, ['controller' => 'Clinicians', 'action' => 'view', $clinicianQualification->clinician->id]) : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $clinicianQualification->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clinicianQualification->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clinicianQualification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clinicianQualification->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>

    <?php
        }
    ?>
