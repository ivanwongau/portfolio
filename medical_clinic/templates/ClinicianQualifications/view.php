<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClinicianQualification $clinicianQualification
 */

use Cake\ORM\TableRegistry;
echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');

?>


<head>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<?php if($this->Identity->get('role')==='2'||$this->Identity->get('role')==='1'){

?>
<div class="clinicianQualifications index content">
    <?= $this->Html->link(__('New Clinician Qualification'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><strong><?= __('All Clinician Qualifications') ?></strong></h3>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('clinician_id') ?></th>
                <th><?= $this->Paginator->sort('qualification') ?></th>
                <th><?= $this->Paginator->sort('date_expire') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clinicianQualifications as $clinicianQualification):

                $itemQuery = TableRegistry::getTableLocator()->get('ClinicianQualifications');
                $clinicianId = $itemQuery->find()->select([])->where(['id' => $clinicianQualification->id])->firstOrFail()->clinician_id;

                $clinicianQuery = TableRegistry::getTableLocator()->get('Clinicians');
                $userId = $clinicianQuery->find()->select([])->where(['id' => $clinicianId])->firstOrFail()->user_id;

                $userQuery = TableRegistry::getTableLocator()->get('Users');
                $userFirstName = $userQuery->find()->select(['first_name'])->where(['id' => $userId])->firstOrFail()->first_name;
                $userSurname = $userQuery->find()->select(['surname'])->where(['id' => $userId])->firstOrFail()->surname;

                if ($clinicianQualification->date_expire != null) {
                    $currentDate = new DateTime("now");
                    $interval = date_diff($clinicianQualification->date_expire, $currentDate);

                    // checks to see if certificate is expired
                    $isBeforeCurrent = false;
                    if ($interval->format('%R') == "+") {
                        $isBeforeCurrent = true;
                    }
                    // calculates the days of difference
                    $daysDifference = $interval->format('%a');

                    if ($isBeforeCurrent && $daysDifference > 0) {
                        ?>
                        <tr style="background-color: lightpink"
                        title="Certificate has expired.">
                        <?php
                    } else {
                        ?>
                        <tr>
                        <?php
                    }
                } else { ?>
                    <tr>
                    <?php
                }
                ?>
                <td><?= $clinicianQualification->has('clinician') ? $this->Html->link($userFirstName . ' ' . $userSurname, ['controller' => 'Clinicians', 'action' => 'view', $clinicianQualification->clinician->id]) : '' ?></td>
                <td><?= h($clinicianQualification->qualification) ?></td>
                <td><?= h($clinicianQualification->date_expire) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clinicianQualification->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clinicianQualification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clinicianQualification->id)]) ?>
                </td>
                </tr>
            <?php
            endforeach; ?>
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

    <button data-toggle="collapse" data-target="#collapseSection" style="float: right">Show Colour Legend</button>
    <div class="border" style="padding: 2%">

        <div id="collapseSection" class="collapse">
            <h3>Qualification Expiry:</h3>
            <p>The table rows are calculated based off whether the referred qualification is <b>expired</b>.</p>

            <div style="padding-top: 2%; text-align: center">
                <table style="width: fit-content; display: inline-block; ">
                    <tr>
                        <th colspan="3">
                            <center>Legend</center>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="1" style="background-color: lightpink; color: lightpink">text</th>
                        <td colspan="2">Expired <p style="color: white; display: inline">......</p></td>
                    </tr>
                    <tr>
                        <th colspan="1" style="background-color: white; color: white">text</th>
                        <td colspan="2">Not expired <p style="color: white; display: inline">......</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <?php
}
?>
