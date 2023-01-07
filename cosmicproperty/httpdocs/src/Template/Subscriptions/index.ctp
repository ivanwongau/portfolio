<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building[]|\Cake\Collection\CollectionInterface $buildings
 * @var \App\Model\Entity\User $user
 */
?>
<div class="pc-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Subscription</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item">Subscription</li>
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
                        <h3 style="float: left"><?= __('SUBSCRIPTIONS') ?></h3>
                        <div class="search-container input-group-prepend">
                            <?php echo $this->Form->create(null, ['type' => 'get']) ?>
                            <div class="input-group search-container">
                                <input id="key" name="key" value="<?php echo $this->request->getQuery('key') ?>"
                                       class="form-control ">
                                <div class="input-group-prepend">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> ', ['escape' => false, 'class' => 'btn btn-primary input-group-text', 'type' => 'submit']) ?>

                                </div>
                            </div>

                            <?php echo $this->Form->end() ?>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('property_id') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('commencement_date') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('period') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('forecast_period_display') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('forecast_in_advance') ?></th>
                                    <th scope="col" class="actions"
                                        style="width: 40%;text-align: left;color: #7267EF"><?= __('Actions') ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($subscriptions as $subscription) : ?>
                                    <tr>
                                        <td><?= $this->Html->link(
                                                $subscription->property->property_name,
                                                ['controller' => 'Properties', 'action' => 'view', $subscription->property->id]
                                            ); ?></td>
                                        <td><?= date_format($subscription->commencement_date,"d/m/Y") ?></td>
                                        <td><?= date_format($subscription->end_date,"d/m/Y")?></td>
                                        <td><?= $this->Number->format($subscription->period) ?></td>
                                        <td><?= $this->Number->format($subscription->forecast_period_display) ?></td>
                                        <td><?= $this->Number->format($subscription->forecast_in_advance) ?></td>
                                        <td class="actions" style="width: 40%">
                                            <a href="<?php echo $this->Url->build(['action' => 'edit', $subscription->id], '') ?>"><i
                                                    title="Edit"
                                                    class="icon feather icon-edit-2 ml-2 f-16 text-warning"></i></a>
                                            <?= $this->Form->postLink('<i title="Delete" class="icon feather icon-trash-2 ml-2 f-16  text-danger"></i>', ['action' => 'delete', $subscription->id], ['escape' => false, 'confirm' => __('Are you sure, you want to delete {0}?', $subscription->id)]) ?>
                                        </td>

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
                <li class="page-item">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </nav>

    </div>
</div>
