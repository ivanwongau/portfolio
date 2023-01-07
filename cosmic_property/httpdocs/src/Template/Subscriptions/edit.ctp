<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $subscription
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
                            <h5 class="m-b-10">Subscription</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item">Subscription
                            </li>

                            <li class="breadcrumb-item">Edit</li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
        <?= $this->Form->create($subscription) ?>
        <form>
            <h1 class="mt-5">Edit Subscription</h1>
            <hr>
            <div class="row">

                <?php
                echo $this->Form->hidden('property_id', ['value' => $buildingid]);
                echo $this->Form->hidden('period', ['value' => $subscription->period]);
                ?>
                <div class="-group col-md-6">

                    <?php echo $this->Form->control('forecast_period_display', array('class' => 'form-control', 'required' => false)); ?>

                </div>
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('forecast_in_advance', array('class' => 'form-control', 'required' => false, 'disabled' => true)); ?>

                </div>
            </div>

            <div class="d-flex">
                <div class="p-2">
                    <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()', 'class' => 'btn  btn-secondary']); ?>
                </div>
                <div class="ml-auto p-2">
                    <?php echo $this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn  btn-primary')) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </form>
    </div>
</div>
