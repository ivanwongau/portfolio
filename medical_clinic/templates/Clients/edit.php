<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link add active" aria-current="page" href="">
                <h4><b>Edit</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=
                <?= $this->Url->build(['controller' => 'Clients', 'action' => 'overview']); ?>>
                <h4>Return to List</h4></a>
        </li>
    </ul>

    <div class="column-responsive column-80">
        <div class="clients form content">
            <?= $this->Form->create($client) ?>
            <fieldset>
                <legend><?= __('Edit Client') ?></legend>
                <?php
                    echo $this->Form->control('diabetes_type');
                    echo $this->Form->control('past_births');
                    echo $this->Form->control('medicare_no');
                    echo $this->Form->control('medicare_ref');
                    echo $this->Form->control('medical_history');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
