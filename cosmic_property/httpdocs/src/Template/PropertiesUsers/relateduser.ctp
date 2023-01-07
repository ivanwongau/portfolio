<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingsUser[]|\Cake\Collection\CollectionInterface $buildingsUsers
 */
?>
<?php 
    foreach ($rename as $row):
        if ($row['id']==42){
            $RelatedUser_RelatedUsers = $row->name;
        }
        if ($row['id']==43){
            $RelatedUser_Invite = $row->name;
            }
        
    endforeach;                             
?>
<div class="pc-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Access Control </h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            </li>
                            <li class="breadcrumb-item"><a href="
                            <?php echo $this->Url->build(['controller' => 'properties', 'action' => 'action', $buildingsUsers->first()->property_id,]) ?>">More
                                    Action</a>
                            </li>
                            <li class="breadcrumb-item">Related Users</li>
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
                        <h3><?= $RelatedUser_RelatedUsers ?> </h3>
                        <!-- <h5><?= __('Related Users') ?></h5> -->
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('property_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('access_level') ?></th>
                                        <th scope="col" class="actions" style="width: 40%;text-align: left;color: #7267EF"><?= __('Actions') ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($buildingsUsers as $buildingsUser) : ?>
                                        <tr>
                                            <td><?= $buildingsUser->user->email ?></td>
                                            <td><?= $buildingsUser->has('user') ? $this->Html->link($buildingsUser->user->first_name, ['controller' => 'Users', 'action' => 'view', $buildingsUser->user->id]) : '' ?></td>
                                            <td><?= $buildingsUser->has('user') ? $this->Html->link($buildingsUser->user->last_name, ['controller' => 'Users', 'action' => 'view', $buildingsUser->user->id]) : '' ?></td>

                                            <td><?= $buildingsUser->has('property') ? $this->Html->link($buildingsUser->property->property_name, ['controller' => 'Properties', 'action' => 'view', $buildingsUser->property->id]) : '' ?></td>
                                            <td><?= $this->Number->format($buildingsUser->access_level) ?></td>
                                            <td class="actions">
                                                <?php if ($user['role']==='admin'){?>
                                                <a href="<?= $this->Url->build(['action' => 'edit', $buildingsUser->id, $access_level, $buildingsUser->user_id]) ?>"><i title="Edit" class="icon feather icon-edit f-16  text-success"></i></a>

                                                        <?= $this->Form->postLink(
                                                            '<i class="icon feather icon-trash-2 ml-2 f-16  text-danger" title="Delete"></i>',
                                                            ['action' => 'deleteRelatedUser', $buildingsUser->id],
                                                            ['escape' => false, 'confirm' => __('Are you sure, you want to delete {0}?', $buildingsUser->id)]
                                                        ); }
                                                        elseif ($access_level == 0) {
                                                    if (($access_level <= ($buildingsUser->access_level) || $access_level == 1) && $access_level != ($buildingsUser->access_level) && ($buildingsUser->access_level != 1 && $access_level == 0)) { ?>
                                                        <a href="<?= $this->Url->build(['action' => 'edit', $buildingsUser->id, $access_level, $buildingsUser->user_id]) ?>"><i title="Edit" class="icon feather icon-edit f-16  text-success"></i></a>

                                                        <?= $this->Form->postLink(
                                                            '<i class="icon feather icon-trash-2 ml-2 f-16  text-danger" title="Delete"></i>',
                                                            ['action' => 'deleteRelatedUser', $buildingsUser->id],
                                                            ['escape' => false, 'confirm' => __('Are you sure, you want to delete {0}?', $buildingsUser->id)]
                                                        ) ?>
                                                    <?php }
                                                } elseif (($access_level <= ($buildingsUser->access_level) || $access_level == 1) && $access_level != ($buildingsUser->access_level)) { ?>
                                                    <a href=" <?= $this->Url->build(['action' => 'edit', $buildingsUser->id, $access_level, $buildingsUser->user_id]) ?>"><i title="Edit" class="icon feather icon-edit f-16  text-success"></i></a>

                                                    <?php echo $this->Form->postLink(
                                                        '<i class="icon feather icon-trash-2 ml-2 f-16  text-danger" title="Delete"></i>',
                                                        ['action' => 'deleteRelatedUser', $buildingsUser->id],
                                                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $buildingsUser->id)]
                                                    ); ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <!--                <li class="page-item">-->
                <!--                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>-->
                <!--                </li>-->
                <!--                <li class="page-item"><a class="page-link" href="#">3</a></li>-->
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>


        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3><?= $RelatedUser_Invite ?> </h3>
                        <!-- <h5><?= __('Invited by email') ?></h5> -->
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('property_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('access_level') ?></th>
                                        <th scope="col" class="actions" style="width: 40%;text-align: left;color: #7267EF"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($invited as $invited) : ?>
                                        <tr>
                                            <td><?= h($invited->email) ?></td>
                                            <td><?= $invited->has('property') ? $this->Html->link($invited->property->id, ['controller' => 'Properties', 'action' => 'view', $invited->property->id]) : '' ?></td>
                                            <td><?= $this->Number->format($invited->access_level) ?></td>
                                            <td class="actions">
                                                <?php if ($user['role']==='admin'){?>
                                                <a href=" <?= $this->Url->build(['controller' => 'invited', 'action' => 'edit', $invited->id, $buildingsUser->property_id, $access_level]) ?>"><i class="icon feather icon-edit f-16  text-success" title="Edit"></i></a>

                                                <?= $this->Form->postLink(
                                                    '<i class="icon feather icon-trash-2 ml-2 f-16  text-danger" title="Delete"></i>',
                                                    ['controller' => 'invited', 'action' => 'delete', $invited->id],
                                                    ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $invited->id)]
                                                ); } elseif ($access_level == 0) {
                                                    if (($access_level <= ($invited->access_level) || $access_level == 1) && $access_level != ($invited->access_level) && ($invited->access_level != 1 && $access_level == 0)) { ?>
                                                        <a href=" >Url->build(['controller' => 'invited', 'action' => 'edit', $invited->id, $buildingsUser->property_id, $access_level]) ?>"><i class="icon feather icon-edit f-16  text-success" title="Edit"></i></a>
                                                        <?= $this->Form->postLink(
                                                            '<i class="icon feather icon-trash-2 ml-2 f-16  text-danger" title="Delete"></i>',
                                                            ['controller' => 'invited', 'action' => 'delete', $invited->id],
                                                            ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $invited->id)]
                                                        ); ?>
                                                    <?php }
                                                } elseif (($access_level <= ($invited->access_level) || $access_level == 1) && $access_level != ($invited->access_level)) { ?>
                                                    <a href=" <?= $this->Url->build(['controller' => 'invited', 'action' => 'edit', $invited->id, $buildingsUser->property_id, $access_level]) ?>"><i class="icon feather icon-edit f-16  text-success" title="Edit"></i></a>

                                                    <?= $this->Form->postLink(
                                                        '<i class="icon feather icon-trash-2 ml-2 f-16  text-danger" title="Delete"></i>',
                                                        ['controller' => 'invited', 'action' => 'delete', $invited->id],
                                                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $invited->id)]
                                                    ); ?>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <!--                <li class="page-item">-->
                <!--                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>-->
                <!--                </li>-->
                <!--                <li class="page-item"><a class="page-link" href="#">3</a></li>-->
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <?php echo $this->Html->link(__('Back'), ['controller' => 'properties','action' => 'action', $buildingsUsers->first()->property_id,], array('type' => 'button', 'class' => 'btn  btn-secondary')) ?>
    </div>
</div>
