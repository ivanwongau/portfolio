<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Property $property
 * @var \App\Model\Entity\PropertyMultiOwnership $propertyMultiOwnership
 * @var \App\Model\Entity\Country $country
 */

?>

<?php
    foreach ($rename as $row):
        if ($row['id']==2){
            $BuildingAdd_AddNewProperty = $row->name;
        }
        if ($row['id']==3){
            $BuildingAdd_PeopertyName = $row->name;
            }

        if ($row['id']==4){
            $BuildingAdd_CommencementDate = $row->name;
        }
        if ($row['id']==5){
            $BuildingAdd_PropertyDes = $row->name;
        }
        if ($row['id']==6){
            $BuildingAdd_Postcode = $row->name;
        }
        if ($row['id']==7){
            $BuildingAdd_PlanOfSubdivisionNumber = $row->name;
        }
        if ($row['id']==8){
            $BuildingAdd_ContributionSafetyNet = $row->name;
        }
        if ($row['id']==9){
            $BuildingAdd_BaseContributionPercentage = $row->name;
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
                            <h5 class="m-b-10"><?= __('Buildings') ?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Building
                                    List</a>
                            </li>
                            <li class="breadcrumb-item">Building Add</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->create($property) ?>
        <form>
            <h1 class="mt-5"><?= $BuildingAdd_AddNewProperty ?></h1>
            <p style="color: red"><b>NOTE : </b>% means the input are in terms of %. E.g. 100 means 100%</p>
            <hr>
            <div class="row">
                <div class="form-group col-md-6">
                                       <!-- <label for="property_name"><?php echo $BuildingAdd_PeopertyName ?></label> -->
                    <?php echo $this->Form->control('property_name', ['class' => 'form-control','label'=>$BuildingAdd_PeopertyName, 'required' => true]) ?>
                                       <!-- <input type="text" class="form-control" id="property_name"  required>
                                   <div class="property_name">Please provide a valid city.</div> -->

                    
                </div>
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control("property_date", array('type' => 'date', 'class' => 'form-control', 'id' => 'example-datemax',
                        'max' => '2099-12-31', 'label' => $BuildingAdd_CommencementDate, 'default' => '')) ?>
                </div>

                

                
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <?php echo $this->Form->control('property_des', ['class' => 'form-control','label'=>$BuildingAdd_PropertyDes, 'rows' => "3", 'required' => ""]) ?>
                
                        <!-- <label for="property_des"><?php echo $BuildingAdd_PropertyDes ?></label>
                            <input type="text" class="form-control" id="property_des"  rows="3" required> -->
                </div>                   

            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('street_number', ['class' => 'form-control', 'required' => true]) ?>
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('street_name', ['class' => 'form-control', 'label' => 'Street Name', 'required' => true]) ?>
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('city', ['class' => 'form-control', 'label' => 'City / Suburbs', 'required' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('state', ['class' => 'form-control', 'label' => 'State', 'required' => true]) ?>
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('postcode', ['class' => 'form-control', 'label'=>$BuildingAdd_Postcode, 'required' => true]) ?>
                    <!-- <label for="postcode"><?php echo $BuildingAdd_Postcode ?></label>
                            <input type="text" class="form-control" id="postcode"   required> -->
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('country', ['class' => 'form-control', 'options' => $editedCountries, 'default' => '13']) ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('year_built', ['class' => 'form-control', 'label' => 'Year built', 'required' => true]); ?>
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('age', ['class' => 'form-control', 'label' => 'Building age', 'required' => true]) ?>
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('plan_of_subdivision_number', ['class' => 'form-control', 'label' => $BuildingAdd_PlanOfSubdivisionNumber, 'required' => true]) ?>
                    <!-- <label for="plan_of_subdivision_number"><?php echo $BuildingAdd_PlanOfSubdivisionNumber ?></label>
                            <input type="text" class="form-control" id="plan_of_subdivision_number"   required> -->
                
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="topic">Building Type</label>
                    <?php echo $this->Form->select('building_type', [
                        'Commercial' => 'Commercial',
                        'Residential' => 'Residential',
                        'Industrial' => 'Industrial',
                        'Business park' => 'Business park',
                        'Manufacturing' => 'Manufacturing',
                        'Private' => 'Private'
                    ], array('class' => 'form-control', 'required' => true)); ?>
                </div>
                <div class="form-group col-md-4">

                    <label for="topic">Ownership Type</label>
                    <?php echo $this->Form->select('ownership_type', [
                        'Single' => 'Single',
                        'Multi' => 'Multi'
                    ], array('class' => 'form-control', 'required' => true)); ?>
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('starting_balance', ['class' => 'form-control', 'label' => 'Existing/Starting balance ($)', 'required' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('contribution_safety_net', ['class' => 'form-control', 'label' => $BuildingAdd_ContributionSafetyNet, 'required' => true]) ?>
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('interest_rate', ['class' => 'form-control', 'label' => 'Interest Rate (%)', 'required' => true]) ?>
                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('inflation_rate', ['class' => 'form-control', 'label' => 'Inflation Rate (%)', 'required' => true]) ?>

                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('base_contribution_percentage', ['class' => 'form-control', 'label' => $BuildingAdd_BaseContributionPercentage, 'required' => true]) ?>

                </div>
                <div class="form-group col-md-4">
                    <?php echo $this->Form->control('tax_rate', ['class' => 'form-control', 'label' => 'Tax Rate (%)', 'required' => true]) ?>

                </div>

                <div class="form-group col-md-4">
                    <?php echo $this->Form->control("maintenance_inspection_date", array('type' => 'date', 'class' => 'form-control', 
                        'max' => '2099-12-31', 'label' => 'Maintenance Inspection Date', 'default' => '')) ?>
                </div>


            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="topic">GST Status</label>
                    <?php echo $this->Form->select('GST_Status', [
                        'Registered' => 'Registered',
                        'Unregister' => 'Unregistered'
                    ], array('class' => 'form-control', 'required' => true)); ?>

                </div>
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('GST', ['class' => 'form-control', 'label' => 'GST (%)', 'required' => true]) ?>
                </div>
            </div>
            <div class="d-flex">
                <div class="p-2">
                    <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()', 'class' => 'btn  btn-secondary']); ?>
                </div>
                <div class="ml-auto p-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </form>
    </div>
</div>
