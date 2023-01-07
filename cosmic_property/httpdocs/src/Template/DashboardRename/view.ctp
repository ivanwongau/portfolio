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

        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="float: left"><?= __('Rename center') ?></h3>
                        <div class="search-container input-group-prepend">
                            <?php echo $this->Form->create(null,['type'=>'get'])?>
                            <!-- <div class="input-group search-container" >
                                <input id="key" name="key" value="<?php echo $this->request->getQuery('key')?>" class="form-control ">
                                <div class="input-group-prepend">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> ',['escape'=>false,'class'=>'btn btn-primary input-group-text','type'=>'submit'])?>

                                </div>
                            </div> -->

                            <?php echo $this->Form->end()?>
                        </div>

                    </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                
                                <tr>
                                    <th scope="row"><?= __('Id') ?></th>
                                    <td><?= $this->Number->format($dashboardRename->id) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <td><?= h($dashboardRename->name) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('System Configured Name') ?></th>
                                    <td><?= h($dashboardRename->System_Configured_Name) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Description') ?></th>
                                    <td><?= h($dashboardRename->Description) ?></td>
                                </tr>
                                <tr>
                                    
                                    <th scope="row"><?= __('Location') ?></th>
                                    <td><?= h($dashboardRename->location);
                                    // $my_str = $dashboardRename->location;

                                    // $arr = explode("/",$str);
                                    //     echo($arr);
                                    
                                    ?></td>
                                </tr>

                                <tr>
                                    <td class="actions" style="width: 40%">
                                        <a href=" <?= $this->Url->build(['action' => 'view', $dashboardRename->id], '') ?>"><i title="View" class="icon feather icon-eye f-16  text-success"></i></a>
                                        <a href=" <?= $this->Url->build(['action' => 'edit', $dashboardRename->id], '') ?>"><i title="Edit" class="icon feather icon-edit-2 ml-2 f-16 text-warning"></i></a>
                                            <!-- <?= $this->Form->postLink(
                                                '<i title="Delete"class="icon feather icon-trash-2 ml-2 f-16  text-danger"></i>',
                                                ['action' => 'delete', $dashboardRename->id],
                                                            ['escape' => false, 'confirm' => __('Are you sure, you want to delete {0}?', $dashboardRenames->id)]
                                                    ) ?> -->
                                        <!-- <a href="javascript:void(0);" οnclick="js_method()">JUMP</a> -->
                                    </td>
                                </tr>
                            </table>

                                


                            </div>
                        </div>



                </div>
            </div>
        </div>

    </div>
</div>

<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dashboard Rename'), ['action' => 'edit', $dashboardRename->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dashboard Rename'), ['action' => 'delete', $dashboardRename->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardRename->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dashboard Rename'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dashboard Rename'), ['action' => 'add']) ?> </li>
    </ul>
</nav> -->
<!-- <div class="dashboardRename view large-9 medium-8 columns content">
    <h3><?= h($dashboardRename->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($dashboardRename->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($dashboardRename->id) ?></td>
        </tr>
    </table>
</div> -->
