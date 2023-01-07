<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Goal $goal
 */
?>
<div class="row">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><h4><b>Edit</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=
                <?= $this->Url->build(['controller' => 'Goals', 'action' => 'index']); ?>>
                <h4>List</h4></a>
        </li>
    </ul>


    <div class="column-responsive column-80">
        <div class="goals form content">
            <?= $this->Form->create($goal) ?>
            <fieldset>
                <legend><?= __('Edit Goal') ?></legend>
                <?php

                echo $this->Form->control('goals_set');
                echo $this->Form->control('completion_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
