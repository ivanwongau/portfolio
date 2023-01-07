<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building $building
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
                            <h5 class="m-b-10">Buildings</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            </li>
                            <li class="breadcrumb-item">Buildings View</li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
        <?= $this->Form->create($building) ?>
        <form>
            <h1 class="mt-5">Edit Building</h1>
            <p style="color: red"><b>NOTE : </b>% means the input are in terms of %. E.g. 100 means 100%</p>
            <hr>
            <div class="row">
                <div class="-group col-md-6">
                    <!--                    ,array('type'=>'text','class'=>'form-control','required'=>false)) ?>  -->
                    <?php echo $this->Form->control('property_name', array('class' => 'form-control', 'required' => false)) ?>
                </div>
                <div class="form-group col-md-6">
                    <?php if ($building->finalized == 'false') {
                        echo $this->Form->control('street_number', array('class' => 'form-control', 'required' => false));
                    } else {
                        echo $this->Form->control('street_number', array(
                            'class' => 'form-control',
                            'required' => false, 'disabled' => true
                        ));
                    } ?>

                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <?php echo $this->Form->control('property_des', array('class' => 'form-control', 'required' => false)) ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == 'false') {
                        echo $this->Form->control('street_name', array('class' => 'form-control', 'required' => false));
                    } else {
                        echo $this->Form->control('street_name', array(
                            'class' => 'form-control',
                            'required' => false, 'disabled' => true
                        ));
                    } ?>
                </div>
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == 'false') {
                        echo $this->Form->control('city', array('class' => 'form-control', 'required' => false));
                    } else {
                        echo $this->Form->control('city', array(
                            'class' => 'form-control',
                            'required' => false, 'disabled' => true
                        ));
                    } ?>
                </div>
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == 'false') {
                        echo $this->Form->control('state', array('class' => 'form-control', 'required' => false));
                    } else {
                        echo $this->Form->control('state', array(
                            'class' => 'form-control',
                            'required' => false, 'disabled' => true
                        ));
                    } ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == 'false') {
                        echo $this->Form->control('postcode', array('class' => 'form-control', 'required' => false));
                    } else {
                        echo $this->Form->control('postcode', array(
                            'class' => 'form-control',
                            'required' => false, 'disabled' => true
                        ));
                    } ?>
                </div>
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == "false") {
                        echo $this->Form->control('country', ['class' => 'form-control', 'options' => $editedCountries,'empty' => $building->country, 'required' => false]);
                    } else {
                        echo $this->Form->control('country', ['class' => 'form-control', 'options' => $editedCountries, 'empty' => $building->country, 'disabled' => true]);
                    } ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="topic">Building type</label>
                    <?php echo $this->Form->select('type', [
                        'Residential' => 'Residential',
                        'Industrial' => 'Industrial',
                        'Commercial' => 'Commercial',
                        'Business park' => 'Business park',
                        'Manufacturing' => 'Manufacturing',
                        'Private' => 'Private'
                    ], array('class' => 'form-control', 'required' => false)) ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="topic">Ownership type</label>
                    <?php echo $this->Form->select('ownership_type', [
                        'Single' => 'Single',
                        'Multi' => 'Multi'
                    ], array('class' => 'form-control', 'required' => false)) ?>
                </div>
                <?php echo $this->Form->hidden('status', array('class' => 'form-control', 'required' => false)); ?>
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == "false") {
                        if ($building->property_date == null){
                            echo $this->Form->control('property_date', array(
                                'type' => 'date','class' => 'form-control',
                                'required' => false, 'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'Commencement Date of the Maintenance Plan'
                            ));
                        } else{
                            echo $this->Form->control('property_date', array(
                                'type' => 'date', 'value' => $building->property_date->i18nFormat('yyyy-MM-dd'), 'class' => 'form-control',
                                'required' => false, 'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'Commencement Date of the Maintenance Plan'
                            ));
                        }
                    } else {
                        if ($building->property_date == null){
                            echo $this->Form->control('property_date', array(
                                'type' => 'date','class' => 'form-control',
                                'required' => false,'disabled' => true,  'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'Commencement Date of the Maintenance Plan'
                            ));
                        } else{
                            echo $this->Form->control('property_date', array(
                                'type' => 'date', 'value' => $building->property_date->i18nFormat('yyyy-MM-dd'), 'class' => 'form-control',
                                'required' => false, 'disabled' => true, 'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'Commencement Date of the Maintenance Plan'
                            ));
                        }
                    } ?>
                </div>
                <div class="form-group col-md-4">
                    <?php
                    if ($building->GST == null) {
                        echo $this->Form->control('GST',
                            ['class' => 'form-control', 'label' => 'GST (%)']);
                    } else {
                        echo $this->Form->control('GST',
                            ['class' => 'form-control', 'label' => 'GST (%)', 'value' => $building['GST'] * 100]);
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == "false") {
                        echo $this->Form->control('year_built', array('class' => 'form-control', 'required' => false));
                    } else {
                        echo $this->Form->control('year_built', array('class' => 'form-control', 'required' => false, 'disabled' => true));
                    } ?>
                </div>
                <div class="form-group col-md-4">
                    <?php
                    if ($building->tax_rate == null) {
                        echo $this->Form->control('tax_rate',
                            ['class' => 'form-control', 'label' => 'Tax Rate (%)']);
                    } else {
                        echo $this->Form->control('tax_rate',
                            ['class' => 'form-control', 'label' => 'Tax Rate (%)', 'value' => $building['tax_rate'] * 100]);
                    }
                    ?>
                </div>
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == "false") {
                        echo $this->Form->control('plan_of_subdivision_number', array('class' => 'form-control', 'required' => false));
                    } else {
                        echo $this->Form->control('plan_of_subdivision_number', array('class' => 'form-control', 'required' => false, 'disabled' => true));
                    } ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('starting_balance', array('class' => 'form-control', 'required' => false, 'label' => 'Starting balance ($)')); ?>
                </div>
                <div class="form-group col-md-4">
                    <?php
                    if ($building->contribution_safety_net == null) {
                        echo $this->Form->control('contribution_safety_net',
                            ['class' => 'form-control', 'label' => 'Contribution safety net (%)'
                            ]);
                    } else {
                        echo $this->Form->control('contribution_safety_net',
                            ['class' => 'form-control', 'label' => 'Contribution safety net (%)', 'value' => $building['contribution_safety_net'] * 100
                            ]);
                    }?>

                </div>
                <div class="form-group col-md-4">
                    <label for="topic">GST status</label>
                    <?php echo $this->Form->select('GST_Status', [
                        'registered' => 'registered',
                        'unregistered' => 'unregistered'
                    ], array('class' => 'form-control', 'required' => false)); ?>
                </div>
                <div class="form-group col-md-4">
                    <?php
                    if ($building->base_contribution_percentage == null) {
                        echo $this->Form->control('base_contribution_percentage',
                            ['class' => 'form-control', 'label' => 'Base Contribution Percentage (%)']);
                    } else {
                        echo $this->Form->control('base_contribution_percentage',
                            ['class' => 'form-control', 'label' => 'Base Contribution Percentage (%)', 'value' => $building['base_contribution_percentage'] * 100]);
                    }

                    
                    ?>
                </div>
                <div class="form-group col-md-4">
                    <?php if ($building->finalized == "false") {
                        echo $this->Form->hidden('age', array('class' => 'form-control', 'required' => false));
                    } else {
                        echo $this->Form->control('age', array('class' => 'form-control', 'required' => false, 'disabled' => true));
                    } ?>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <?php
                        if ($user->role == 'admin') {
                            if ($building->interest_rate == null) {
                                echo $this->Form->control('interest_rate',
                                    ['class' => 'form-control', 'label' => 'Interest rate (%)']);
                            } else {
                                echo $this->Form->control('interest_rate',
                                    ['class' => 'form-control', 'label' => 'Interest rate (%)', 'value' => $building['interest_rate'] * 100]);
                            }
                        } else {
                        if ($building->interest_rate == null) {
                            echo $this->Form->hidden('interest_rate',
                                ['class' => 'form-control', 'label' => 'Interest rate (%)']);
                        } else {
                            echo $this->Form->hidden('interest_rate',
                                ['class' => 'form-control', 'label' => 'Interest rate (%)', 'value' => $building['interest_rate'] * 100]);
                        } }?>
                    </div>
                    <div class="form-group col-md-4">
                        <?php
                        if ($user->role == 'admin') {
                            
                            if ($building->inflation_rate == null) {
                                echo $this->Form->control('inflation_rate',
                                    ['class' => 'form-control', 'label' => 'Inflation rate (%)']);

                                
                            } else {
                                echo $this->Form->control('inflation_rate',
                                    ['class' => 'form-control', 'label' => 'Inflation rate (%)', 'value' => $building['inflation_rate'] * 100]);
                            }
                        } else {

                            if ($building->inflation_rate == null) {
                                echo $this->Form->hidden('inflation_rate',
                                    ['class' => 'form-control', 'label' => 'Inflation rate (%)']);
                            } else {
                                echo $this->Form->hidden('inflation_rate',
                                    ['class' => 'form-control', 'label' => 'Inflation rate (%)', 'value' => $building['inflation_rate'] * 100]);
                            }

                        } 

                        
                        
                             
                                
                        

                        ?>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-4">
                    <!-- <?php
                    // if ($building->maintenance_inspection_date == null) {
                    //     echo $this->Form->control('maintenance_inspection_date', array(
                    //                 'type' => 'date','class' => 'form-control',
                    //                 'required' => false, 'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'maintenance_inspection_date'
                    //             ));
                    //         }
                    //     ?> -->
                

                <?php if ($building->finalized == "false") {
                        if ($building->maintenance_inspection_date == null){
                            echo $this->Form->control('maintenance_inspection_date', array(
                                'type' => 'date','class' => 'form-control',
                                'required' => false, 'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'maintenance_inspection_date'
                            ));
                        } else{
                            echo $this->Form->control('maintenance_inspection_date', array(
                                'type' => 'date', 'value' => $building->maintenance_inspection_date->i18nFormat('yyyy-MM-dd'), 'class' => 'form-control',
                                'required' => false, 'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'maintenance_inspection_date'
                            ));
                        }
                    } else {
                        if ($building->property_date == null){
                            echo $this->Form->control('maintenance_inspection_date', array(
                                'type' => 'date','class' => 'form-control',
                                'required' => false,'disabled' => true,  'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'maintenance_inspection_date'
                            ));
                        } else{
                            echo $this->Form->control('maintenance_inspection_date', array(
                                'type' => 'date', 'value' => $building->maintenance_inspection_date->i18nFormat('yyyy-MM-dd'), 'class' => 'form-control',
                                'required' => false, 'disabled' => true, 'id' => 'example-datemax', 'max' => '2099-12-31', 'label'=>'maintenance_inspection_date'
                            ));
                        }
                    } ?>
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
