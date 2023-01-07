<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

echo $this->Html->css('primaryTable.css');

?>

<head>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<?php if ($this->Identity->get('role') === '1') {

    ?>
    <div class="users index content">
        <?=
        $this->Form->create(null, ['url' => ['action' => 'deleteAll']])
        ?>
        <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>

        <h3><?= __('Users') ?></h3>

        <div class="table-responsive">
            <button class="rounded">Delete All</button>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>User ID</th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th><?= $this->Paginator->sort('last_login') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user):

                    if ($user->last_login != null) {
                        $currentDate = new DateTime("now");
                        $interval = date_diff($user->last_login, $currentDate);

                        // checks to see if certificate is expired
                        $isBeforeCurrent = false;
                        if ($interval->format('%R') == "+") {
                            $isBeforeCurrent = true;
                        }
                        // calculates the days of difference
                        $daysDifference = $interval->format('%a');

                        if ($isBeforeCurrent && $daysDifference > 7) {
                            ?>
                            <tr style="background-color: lightpink"
                            title="<?= ($user->first_name) . ' ' . ($user->surname) . ' has not logged in for over a week.' ?>">
                            <?php
                        } else {
                            ?>
                            <tr>
                            <?php
                        }
                    } else { ?>
                        <tr style="background-color: lightgray"
                        title="<?= ($user->first_name) . ' ' . ($user->surname) . ' has not logged in at all.' ?>">
                        <?php
                    }
                    ?>
                    <td><?= $this->Form->checkbox('ids[]', ['value' => $user->id]) ?> </td>
                    <td><?= h($user->id) ?></td>
                    <td><?= h($user->first_name) . ' ' . h($user->surname) ?></td>
                    <td>
                        <?php
                        if ($user->role == '1') {
                            echo "Managerial Clinician";
                        } else if ($user->role == '2') {
                            echo "Clinician";
                        } else if ($user->role == '3') {
                            echo "Client";
                        }
                        ?>
                    </td>
                    <td><?= h($user->created_date) ?></td>
                    <td><?= h($user->modified_date) ?></td>
                    <td><?= h($user->last_login) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                    </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
            <?= $this->Form->end() ?>

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
            <h3>Last time a user has logged in:</h3>
            <p>The table rows are calculated based off the last time a client has <b>logged into the system</b>.</p>

            <div style="padding-top: 2%; text-align: center">
                <table style="width: fit-content; display: inline-block; ">
                    <tr>
                        <th colspan="3">
                            <center>Legend</center>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="1" style="background-color: lightpink; color: lightpink">text</th>
                        <td colspan="2">Over a week ago <p style="color: white; display: inline">......</p></td>
                    </tr>
                    <tr>
                        <th colspan="1" style="background-color: lightgrey; color: lightgray">text</th>
                        <td colspan="2" style="padding: 10px">Never <p style="color: white;  display: inline">......</p>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" style="background-color: white; color: white">text</th>
                        <td colspan="2">Within the week <p style="color: white; display: inline">......</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <?php
}
?>
