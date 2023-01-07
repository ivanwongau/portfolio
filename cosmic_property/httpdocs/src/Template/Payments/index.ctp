<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>Sidebar Dashboard Template With Sub Menu</title>
    <?= $this->Html->css('loginstyle.css'); ?>

</head>


<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Payment</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:history.go(-1);">Add New Subscription</a>
                            </li>
                            <li class="breadcrumb-item">Payment</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <h2 class="mt-5">Payment Confirmation Page</h2>
        <hr>

        <?php echo $this->Form->create($user, array('class' => 'needs-validation')) ?>
        <div class="row">

            <?= $this->Form->create(null, ['class' => 'cls-form']) ?>
            <h4><b>Building Name : </b> <?php echo $building_data[0]->property_name ?></h4>
            <h4><b>Building Address : </b> <?php echo $building_data[0]->street_number.' '.$building_data[0]->street_name . ', ' . $building_data[0]->city . ', ' . $building_data[0]->state . ', ' . $building_data[0]->postcode ?></h4>
            <h4><b>Commencement Date of the Subscription: </b> <?php echo $subsArray['commencement_date']['day'] . '-', $subsArray['commencement_date']['month'], '-' . $subsArray['commencement_date']['year'] ?></h4>
            <h4><b>End Date : </b> <?php echo $subsArray['end_date']['day'] . '-', $subsArray['end_date']['month'], '-' . $subsArray['end_date']['year'] ?></h4>
            <h4><b>Final Price : </b> <?php echo '$' . $subsArray['period'] * 150 ?></h4>




            <!--<label class="w3-text-blue"><b>Enter Amount</b></label>-->
            <?= $this->Form->hidden('amount', ['class' => 'form-control', 'value' => $value]) ?>
        </div>
        <div class="d-flex">
            <div class="p-2">
                <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()', 'class' => 'btn  btn-secondary']); ?>
            </div>
            <div class="ml-auto p-2">
                <button class="btn btn-primary">Pay with PayPal</button>
            </div>
        </div>
        <?= $this->Form->end() ?>


    </div>
</div>
