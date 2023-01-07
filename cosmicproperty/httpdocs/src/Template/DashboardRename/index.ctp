<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardRename[]|\Cake\Collection\CollectionInterface $dashboardRename
 */

?>
<div class="pc-container">
    <div class="pcoded-content">

        <!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
            <ul class="side-nav">
                <li class="heading"><?= __('Actions') ?></li>
                <li><?= $this->Html->link(__('New Dashboard Rename'), ['action' => 'add']) ?></li>
            </ul>
        </nav> -->

        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="float: left"><?= __('Dashboard Rename') ?></h3>
                        <div class="search-container input-group-prepend">
                            <?php echo $this->Form->create(null,['type'=>'get'])?>
                            <div class="input-group search-container" >
                                <input id = "key" name="key" System_Configured_Name ="key" location="key" Description="key"
                                value="<?php echo $this->request->getQuery('key')?>" class="form-control ">
                                <!-- <?= $this->form->control('key',['label'=>''])?> -->
                                <div class="input-group-prepend">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> ',['escape'=>false,'class'=>'btn btn-primary input-group-text','type'=>'submit'])?>

                                </div>
                            </div>

                            <?php echo $this->Form->end()?>
                        </div>

                    </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('System_Configured_Name') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('location') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('Description') ?></th>
                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                        <tbody>
                            <?php foreach ($dashboardRename as $dashboardRename): ?>
                            <tr>
                                <td><?= $this->Number->format($dashboardRename->id) ?></td>
                                <td>
                                    <?php

                                        echo $this->Text->truncate(
                                            h($dashboardRename->name),
                                                50,
                                                [
                                                    'ellipsis' => '...',
                                                    'exact' => false
                                                ]
                                            );
                                    ?>

                                </td>
                                <td>
                                    <?php
                                        echo $this->Text->truncate(
                                            h($dashboardRename->System_Configured_Name),
                                                50,
                                                [
                                                    'ellipsis' => '...',
                                                    'exact' => false
                                                ]
                                            );

                                    ?>
                                </td>
                                <td><?= h($dashboardRename->location);

                                        // $my_str = $dashboardRename->location;

                                        //  $arr = explode("/",$my_str);
                                        //      print_r($arr);


                                    ?>

                                </td>
                                <td>
                                    <?php
                                        echo $this->Text->truncate(
                                            h($dashboardRename->Description),
                                                50,
                                                [
                                                    'ellipsis' => '...',
                                                    'exact' => false
                                                ]
                                            );

                                    ?>


                                </td>

                                <td class="actions">
                                <a href=" <?= $this->Url->build(['action' => 'view', $dashboardRename->id], '') ?>"><i title="View" class="icon feather icon-eye f-16  text-success"></i></a>
                                    <a href=" <?= $this->Url->build(['action' => 'edit', $dashboardRename->id], '') ?>"><i title="Edit" class="icon feather icon-edit-2 ml-2 f-16 text-warning"></i></a>

                                    <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $dashboardRename->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dashboardRename->id]) ?> -->
                                    <!-- <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dashboardRename->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardRename->id)]) ?> -->
                                    <a href="<?= h($dashboardRename->Url)?>" target="_blank">JUMP</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>


                    </table>
                    <div class="paginator">
                        <ul class="pagination pagination-circle justify-content-center flex">
                            <?= $this->Paginator->prev("<<") ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(">>") ?>
                        </ul>
                        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                    </div>

                </div>
            </div>



                </div>
            </div>
        </div>

    </div>
</div>
<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardRename[]|\Cake\Collection\CollectionInterface $dashboardRename
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Dashboard Rename'), ['action' => 'add']) ?></li>
    </ul>
</nav>

<div class="dashboardRename index large-9 medium-8 columns content">
    <h3><?= __('Dashboard Rename') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('System_Configured_Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dashboardRename as $dashboardRename): ?>
            <tr>
                <td><?= $this->Number->format($dashboardRename->id) ?></td>
                <td><?= h($dashboardRename->name) ?></td>
                <td><?= h($dashboardRename->System_Configured_Name) ?></td>
                <td><?= h($dashboardRename->location) ?></td>
                <td><?= h($dashboardRename->Description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dashboardRename->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dashboardRename->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dashboardRename->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardRename->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div> -->


