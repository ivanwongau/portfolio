<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry[]|\Cake\Collection\CollectionInterface $enquiries
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Admin</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item">Enquires</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h3 style="float: left"><?= __('ENQUIRIES') ?></h3>
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

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('temp_email') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('topic') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                        <th scope="col" style="width: 40%;text-align: left;color: #7267EF">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($enquiries as $enquiry) : ?>
                                        <tr>
                                            <a href=""></a>
                                            <td><?= h($enquiry->name) ?></td>
                                            <td><?= h($enquiry->temp_email) ?></td>
                                            <td><?= h($enquiry->topic) ?></td>
                                            <td><?= date_format($enquiry->date,"d/m/Y") ?></td>
                                            <td><?= h($enquiry->status) ?></td>
                                            <td>
                                                <a href=" <?= $this->Url->build(['action' => 'view', $enquiry->id]) ?>"><i class="icon feather icon-eye f-16  text-success" title="View"></i></a>
                                                <?php if ($enquiry->status == 'open') { ?>
                                                    <a href="<?= $this->Url->build(['controller' => 'enquiries', 'action' => 'close', $enquiry->id]) ?>"><i class="icon feather icon-lock ml-2 f-16  text-dark" title="Lock"></i></a>
                                                <?php } ?>
                                                <?php if ($enquiry->status == 'close') { ?>
                                                    <a href="<?= $this->Url->build(['controller' => 'enquiries', 'action' => 'open', $enquiry->id]) ?>"><i class="icon feather icon-unlock ml-2 f-16  text-warning" title="Unlock"></i></a>
                                                <?php } ?>
                                                <!--15/5change-->
                                                <?= $this->Form->postLink('<i class="icon feather icon-trash-2 ml-2 f-16  text-danger" title="Delete"></i>', ['action' => 'delete', $enquiry->id], ['escape' => false, 'confirm' => __('Are you sure, you want to delete {0}?', $enquiry->id)]) ?>
                                                <!--15/5change-->
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
    </div>
</div>
