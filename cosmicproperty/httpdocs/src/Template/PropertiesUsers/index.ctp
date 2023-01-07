<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingsUser[]|\Cake\Collection\CollectionInterface $buildingsUsers
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingsUser[]|\Cake\Collection\CollectionInterface $buildingsUsers
 */
?>


<div class="pc-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Access Control</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item">ACCESS CONTROL</li>
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
                        <h3 style="float: left"><?= __('ACCESS CONTROL') ?></h3>
                        <div class="search-container input-group-prepend">
                            <?php echo $this->Form->create(null,['type'=>'get'])?>
                            <div class="input-group search-container" >
                                <input id="key" name="key" value="<?php echo $this->request->getQuery('key')?>" class="form-control ">
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
                                        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('building_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('access_level') ?></th>
                                        <th scope="col" class="actions" style="width: 40%;text-align: left;color: #7267EF"><?= __('Actions') ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($buildingsUsers as $buildingsUser) : ?>
                                        <tr style="width: 40%">
                                            <td><?= $buildingsUser->has('user') ? $this->Html->link($buildingsUser->user->email, ['controller' => 'Users', 'action' => 'view', $buildingsUser->user->id]) : '' ?></td>
                                            <td><?= $buildingsUser->has('user') ? $this->Html->link($buildingsUser->user->first_name, ['controller' => 'Users', 'action' => 'view', $buildingsUser->user->id]) : '' ?></td>
                                            <td><?= $buildingsUser->has('user') ? $this->Html->link($buildingsUser->user->last_name, ['controller' => 'Users', 'action' => 'view', $buildingsUser->user->id]) : '' ?></td>
                                            <td><?= $buildingsUser->has('property') ? $this->Html->link($buildingsUser->property->property_name, ['controller' => 'Properties', 'action' => 'view', $buildingsUser->property->id]) : '' ?></td>
                                            <td><?= $this->Number->format($buildingsUser->access_level) ?></td>
                                            <td class="actions">
                                                <?= $this->Form->postLink(__(''), ['action' => 'deleteRelatedUser', $buildingsUser->id], ['class' => 'icon feather icon-trash-2 ml-2 f-16  text-danger', 'title' => "Delete", 'confirm' => __('Are you sure you want to delete # {0}?', $buildingsUser->id)]) ?>
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
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </nav>

    </div>
</div>
