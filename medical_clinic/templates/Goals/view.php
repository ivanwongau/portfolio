<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Goal $goal
 */
echo $this->Html->css('primaryTable.css');
?>
    <div class="topTabBar">
        <br>
        <h1>View your goals</h1>
        <br><br>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" style="display:inline-block;" href=
                    <?= $this->Url->build(['controller' => 'Goals', 'action' => 'index', $goal->id]); ?>>
                    <h4><b>View</b></h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="display:inline-block;" href=
                    <?= $this->Url->build(['controller' => 'Goals', 'action' => 'edit', $goal->id]); ?>>
                    <h4>Edit</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="display:inline-block;" href=
                    <?= $this->Url->build(['controller' => 'Goals', 'action' => 'index']); ?>>
                    <h4>List</h4>
                </a>
        </ul>
    </div>


    <div class="column-responsive column-80">
        <div class="goals view content">
            <h3><?= h($goal->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $goal->has('client') ? $this->Html->link($goal->client->full_name, ['controller' => 'Clients', 'action' => 'view', $goal->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Goals Set') ?></th>
                    <td><?= h($goal->goals_set) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($goal->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Completion Date') ?></th>
                    <td><?= h($goal->completion_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
