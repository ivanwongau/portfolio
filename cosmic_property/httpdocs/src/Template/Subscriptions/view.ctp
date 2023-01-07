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
 * @var \App\Model\Entity\BuildingsUser[]|\Cake\Collection\CollectionInterface $buildingsUsers
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

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
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            </li>
                            <!--14/5change-->
                            <li class="breadcrumb-item"><a href="
                            <?php echo $this->Url->build(['controller' => 'properties', 'action' => 'action', $subscription->property_id]) ?>">More
                                    Action</a>
                            </li>
                            <!--14/5change-->

                            <li class="breadcrumb-item">Subscription View</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="p-2">
                                <h5>Subscription View</h5>
                            </div>
                            <div class="ml-auto p-2">
                                <?php echo $this->Html->link(
                                    __('Edit'),
                                    ['controller' => 'subscriptions', 'action' => 'edit', $subscription->id],
                                    array('class' => 'btn btn-primary', 'type' => 'button')
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th scope="row"><?= __('Building') ?></th>
                                    <td><?= $subscription->has('property') ? $this->Html->link($subscription->property->property_name, ['controller' => 'Properties', 'action' => 'view', $subscription->property->id]) : '' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Period') ?></th>
                                    <td><?= $this->Number->format($subscription->period) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Forecast Period Display') ?></th>
                                    <td><?= $this->Number->format($subscription->forecast_period_display) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Forecast In Advance') ?></th>
                                    <td><?= $this->Number->format($subscription->forecast_in_advance) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Commencement Date of the Subscriptions') ?></th>
                                    <td><?= date_format($subscription->commencement_date, "d/m/Y") ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('End Date') ?></th>
                                    <td><?= date_format($subscription->end_date, "d/m/Y") ?></td>
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="p-2">
                <a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'action', $subscription->property_id]) ?>">
                    <button class="btn btn-secondary">Back</button>
                </a></div>
            <div class="ml-auto p-2">
                <?php echo $this->Html->link(__('Extend the subscription'), ['controller' => 'subscriptions', 'action' => 'renew', $subscription->id], array('type' => 'button', 'class' => 'btn  btn-primary')) ?>
            </div>
        </div>

    </div>
</div>

</html>
