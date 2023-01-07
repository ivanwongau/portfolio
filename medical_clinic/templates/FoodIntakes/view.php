<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FoodIntake $foodIntake
 */
?>

<div class="topTabBar">
    <br>
    <h1>View your food intake</h1>
    <br><br>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'index', $foodIntake->id]); ?>>
                <h4><b>View</b></h4>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'edit', $foodIntake->id]); ?>>
                <h4>Edit</h4>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'index']); ?>>
                <h4>List</h4>
            </a>
    </ul>
</div>

<div class="row">
    <div class="column-responsive column-80">
        <div class="foodIntakes view content">
            <h4 style="float: right">
                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $foodIntake->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $foodIntake->id)]
                ) ?>
            </h4>

            <h3><?= h($foodIntake->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $foodIntake->has('client') ? $this->Html->link($foodIntake->client->id, ['controller' => 'Clients', 'action' => 'view', $foodIntake->client->id]) : '' ?></td>
                </tr>

                <tr>
                    <th><?= __('Food Eaten') ?></th>
                    <td><?= h($foodIntake->food_eaten) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($foodIntake->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Logged Time') ?></th>
                    <td><?= h($foodIntake->logged_time) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
