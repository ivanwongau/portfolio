<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientCondition $clientCondition
 */
?>
<div class="row">
    <div class="topTabBar">
        <br>
        <h1>View your current medical condition</h1>
        <br><br>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"><h4><b>View</b></h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=
                    <?= $this->Url->build(['controller' => 'ClientConditions', 'action' => 'edit', $clientCondition->id]); ?>>
                    <h4>Edit</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=
                    <?= $this->Url->build(['controller' => 'ClientConditions', 'action' => 'index']); ?>>
                    <h4>List</h4></a>
            </li>
        </ul>
    </div>
</div>


    <div class="column-responsive column-80">
        <div class="clientConditions view content">
            <h4 style="float: right">
                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $clientCondition->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $clientCondition->id)]
                ) ?>
            </h4>
            <h3><?= h($clientCondition->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Insulin Level') ?></th>
                    <td><?= h($clientCondition->insulin_level) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $clientCondition->has('client') ? $this->Html->link($clientCondition->client->id, ['controller' => 'Clients', 'action' => 'view', $clientCondition->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($clientCondition->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Weight') ?></th>
                    <td><?= $this->Number->format($clientCondition->weight) ?></td>
                </tr>
                <tr>
                    <th><?= __('BMI') ?></th>
                    <td><?= $this->Number->format($clientCondition->BMI) ?></td>
                </tr>
                <tr>
                    <th><?= __('Logged Time') ?></th>
                    <td><?= h($clientCondition->logged_time) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
