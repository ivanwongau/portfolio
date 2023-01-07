<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardRename $dashboardRename
 */
?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardRename $dashboardRename
 */
?>
<div class="pc-container">
    <div class="pcoded-content">
        <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Rename Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'dashboardRename', 'action' => 'index']) ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item">Rename</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
            <ul class="side-nav">
                <li class="heading"><?= __('Actions') ?></li>
                <li><?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $dashboardRename->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardRename->id)]
                    )
                ?></li>
                <li><?= $this->Html->link(__('List Dashboard Rename'), ['action' => 'index']) ?></li>
            </ul>
        </nav> -->
        <div class="col-md-12 row ">
            <div class="table-responsive row card">
                <?= $this->Form->create($dashboardRename) ?>
                <div class="table-responsive">

                    <fieldset>

<!--                        <legend><div class="card-header">--><?//= __('Edit Dashboard Rename') ?><!--</div></legend>-->
                        <legend><div class="card-header">Edit <?= h($dashboardRename->name) ?></div></legend>
                        <div class="form-group col-md-6">
                            <?php
                                // echo $this->Form->control('name',['class' => 'form-control', 'label' => 'Edit Name: ','type' => 'textarea']);
                                echo $this->Form->control('name', ['class' => 'form-control','rows' => '10', 'maxlength'=>"5000",'label' => 'Edit Name:', 'type' => 'textarea']);

                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php

                                echo $this->Form->control('Description',['class' => 'form-control', 'label' => 'Edit Description: ', 'required' => false]);
                            ?>
                        </div>
                    </fieldset>
                    <!-- <fieldset>
                        <legend><?= __('Edit Dashboard Rename') ?></legend>
                        <?php
                            echo $this->Form->control('name', ['class' => 'form-control','label' => 'Edit Name:','rows' => '30', 'maxlength'=>"10", 'type' => 'textarea']);
                            echo $this->Form->control('Description',['class' => 'form-control', 'label' => 'Edit Description: ', 'required' => false]);
                        ?>
                    </fieldset> -->
                    <?= $this->Form->button(__('Submit'),['class'=>'mb-3 center btn-primary']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dashboardRename->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardRename->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dashboard Rename'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dashboardRename form large-9 medium-8 columns content">
    <?= $this->Form->create($dashboardRename) ?>
    <fieldset>
        <legend><?= __('Edit Dashboard Rename') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('System_Configured_Name');
            echo $this->Form->control('location');
            echo $this->Form->control('Description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div> -->
