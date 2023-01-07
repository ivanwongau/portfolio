<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientCondition $clientCondition
 */
?>
<div class="row">
    <div class="topTabBar">
        <br>
        <h1>Edit your medical logs</h1>
        <br><br>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'ClientConditions', 'action' => 'index', $clientCondition->id]); ?>>
                <h4>View</h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" style="display:inline-block;" href=
                    <?= $this->Url->build(['controller' => 'ClientConditions', 'action' => 'edit', $clientCondition->id]); ?>>
                    <h4><b>Edit</b></h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="display:inline-block;" href=
                    <?= $this->Url->build(['controller' => 'ClientConditions', 'action' => 'index']); ?>>
                    <h4>List</h4></a>
        </ul>
    </div>
</div>

<div class="row">
    <div class="column-responsive column-80">
        <div class="clientConditions form content">
            <h4 style="float: right">
                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $clientCondition->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $clientCondition->id)]
                ) ?>
            </h4>

            <?= $this->Form->create($clientCondition) ?>
            <fieldset>
                <legend><?= __('Edit Client Condition') ?></legend>
                <?php
                    echo $this->Form->control('insulin_level');
                    echo $this->Form->control('weight');
                    echo $this->Form->control('BMI');
                    echo $this->Form->control('logged_time');
                    echo $this->Form->control('client_id', ['options' => $clients, 'hiddenField' => true, 'type' => 'hidden']);
                ?>
            </fieldset>
            <br><br>
            <a style="float: right;">
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
            </a>
            <br><br>
        </div>
    </div>
</div>

<br><br><br>
