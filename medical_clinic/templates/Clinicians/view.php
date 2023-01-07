<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinician $clinician
 */

use Cake\ORM\TableRegistry;

echo $this->Html->css('secondaryTable.css');

?>
<?php if($this->Identity->get('role')==='2'||$this->Identity->get('role')==='1'){

?>

<div class="row">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><h4><b>View</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=
                <?= $this->Url->build(['controller' => 'Clinicians', 'action' => 'index']); ?>>
                <h4>Return to List</h4></a>
        </li>
    </ul>

    <div class="column-responsive column-80">
        <div class="clinicians view content">
            <h3><strong>Clinician Information</strong></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $clinician->has('user') ? $this->Html->link($clinician->user->id, ['controller' => 'Users', 'action' => 'view', $clinician->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?=$clinician->user->first_name.' '.$clinician->user->surname?></td>
                </tr>
                <tr>
                    <th><?= __('Medical Specialty') ?></th>
                    <td><?= h($clinician->medical_specialty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($clinician->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4>Assigned Clients</h4>
                <?php if (!empty($clinician->clients)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Diabetes Type') ?></th>
                            <th><?= __('Past Births') ?></th>
                            <th><?= __('Medicare No') ?></th>
                            <th><?= __('Medicare Ref') ?></th>
                            <th><?= __('Medical History') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($clinician->clients as $clients) : ?>
                        <tr>
                            <?php
                            $usersQuery = TableRegistry::getTableLocator()->get('Users');
                            $clientUser = $usersQuery->find()->select([])->where(['id' => $clients->user_id])->first();
                            ?>
                            <td><?= h($clientUser->first_name.' '.$clientUser->surname) ?></td>
                            <td><?= h($clients->diabetes_type) ?></td>
                            <td><?= h($clients->past_births) ?></td>
                            <td><?= h($clients->medicare_no) ?></td>
                            <td><?= h($clients->medicare_ref) ?></td>
                            <td><?= h($clients->medical_history) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Clients', 'action' => 'view', $clients->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Clients', 'action' => 'edit', $clients->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Clients', 'action' => 'delete', $clients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clients->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4>Qualifications</h4>
                <?php if (!empty($clinician->clinician_qualifications)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Qualification') ?></th>
                            <th><?= __('Date Expire') ?></th>
                            <th><?= __('Clinician Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($clinician->clinician_qualifications as $clinicianQualifications) : ?>
                        <tr>
                            <td><?= h($clinicianQualifications->qualification) ?></td>
                            <td><?= h($clinicianQualifications->date_expire) ?></td>
                            <td><?= h($clinicianQualifications->clinician_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ClinicianQualifications', 'action' => 'view', $clinicianQualifications->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ClinicianQualifications', 'action' => 'edit', $clinicianQualifications->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ClinicianQualifications', 'action' => 'delete', $clinicianQualifications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clinicianQualifications->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
    <?php
}
?>
