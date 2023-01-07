<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building $building
 * @var \App\Model\Entity\User $user
 */
?>
<?php 
    foreach ($rename as $row):
        if ($row['id']==10){
            $NewBuildingView_BuildingView = $row->name;
        }
        if ($row['id']==11){
            $NewBuildingView_POSTCODE = $row->name;
        }
        if ($row['id']==12){
            $NewBuildingView_PROPERTYDESCRIPTION = $row->name;
        }
        if ($row['id']==13){
            $NewBuildingView_TYPE = $row->name;
        }
        if ($row['id']==14){
            $NewBuildingView_STATUS = $row->name;
        }
        if ($row['id']==15){
            $NewBuildingView_FINALIZED = $row->name;
        }
    endforeach;                             
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
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'properties','action'=>'buildinglist']) ?>">Buildings</a></li>
                            <li class="breadcrumb-item">Buildings View</li>
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
                        <div class="d-flex">
                            <div class="p-2">
                                <h3><?= $NewBuildingView_BuildingView ?></h3>
                            </div>

                            <div class="ml-auto p-2">
                                <?php if ($user->role == 'admin' || $access_level < 4) { ?>
                                    <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $building->id],
                                        array('class' => 'btn btn-primary','type'=>'button')) ?>
                                <?php } ?>

                        
<!-- 
                                ?= $this->Form->postLink(__(''), ['action' => 'delete', $building->id], 
                                ['class' => 'icon feather icon-trash-2 ml-2 f-16  text-danger btn btn-info', 'title' => "Delete",
                                 'confirm' => __('Are you sure you want to delete # {0}?, Once you click yes,all info will be deleted!', $building->property_name)]) ?> -->


                            </div>


                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><?= __('Name') ?></th>
                                    <td><?= h($building->property_name) ?></td>
                                    <th scope="row"><?= __('Commencement Date of the Maintenance Plan') ?></th>
                                    <td>
                                        <?php
                                        if ($building->property_date == null){
                                            echo null;
                                        } else {
                                            echo date_format($building->property_date,"d/m/Y");

                                        }
                                        ?>
                                    </td>
                                </tr>
<!--                                ----------------------------  ------------------------------------------------- change-->
                                <tr>
                                    <th scope="row"><?= __('Street number') ?></th>
                                    <td><?= h($building->street_number) ?></td>
                                    <th scope="row"><?= __('TAX RATE') ?></th>
                                    <td><?= $this->Number->format($building->tax_rate) * 100 ." %" ?></td>
                                </tr
<!------------------------------  ------------------------------------------------- change-->
                                <tr>
                                    <th scope="row"><?= __('Street') ?></th>
                                    <td><?= h($building->street_name) ?></td>
                                    <th scope="row"><?= __('Starting Balance') ?></th>
                                    <td><?= $this->Number->format($building->starting_balance,[
                                            'before' => '$ ',
                                        ]) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('City') ?></th>
                                    <td><?= h($building->city) ?></td>
                                    <th scope="row"><?= __('Interest Rate') ?></th>
                                    <td><?= $this->Number->format($building->interest_rate,['precision'=>4]) * 100 ."%"?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('States') ?></th>
                                    <td><?= h($building->state) ?></td>
                                    <th scope="row"><?= __('Inflation Rate') ?></th>
                                    <td><?= $this->Number->format($building->inflation_rate,['precision'=>4]) * 100 ." %"?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Country') ?></th>
                                    <td><?= h($building->country) ?></td>
                                    <th scope="row"><?= __('GST_status') ?></th>
                                    <td><?= h($building->GST_Status) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __($NewBuildingView_POSTCODE) ?></th>
                                    <td><?= h($building->postcode) ?></td>
                                    <th scope="row"><?= __('GST') ?></th>
                                    <td><?= $this->Number->format($building->GST)* 100 ." %" ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Year built') ?></th>
                                    <td><?= $this->Number->format($building->year_built) ?></td>
                                    <th scope="row"><?= __('age') ?></th>
                                    <td><?= $this->Number->format($building->age) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __($NewBuildingView_PROPERTYDESCRIPTION) ?></th>
                                    <td><?= h($building->property_des) ?></td>
<!------------------------------  ------------------------------------------------- change-->
                                    <th scope="row"><?= __('BASE CONTRIBUTION PERCENTAGE') ?></th>
                                    <td><?= $this->Number->format($building->base_contribution_percentage)*100 .' %' ?></td>
<!-- -----------------------------  ------------------------------------------------- change-->
                                </tr>
                                <tr>
                                    <th scope="row"><?= __($NewBuildingView_TYPE) ?></th>
                                    <td><?= h($building->building_type) ?></td>
                                    <th scope="row"><?= __('Contribution Safety Net') ?></th>
                                    <td><?= $this->Number->format($building->contribution_safety_net,['precision'=>4])* 100 ." %" ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Ownership Type') ?></th>
                                    <td><?= h($building->ownership_type) ?></td>
                                    <th scope="row"><?= __('Plan of subdivision number') ?></th>
                                    <td><?= h($building->plan_of_subdivision_number) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __($NewBuildingView_STATUS) ?></th>
                                    <td><?= h($building->status) ?></td>
                                    <th scope="row"><?= __($NewBuildingView_FINALIZED) ?></th>
                                    <td><?= h($building->finalized) ?></td>
                                </tr>

                                <tr>
                                <th scope="row"><?= __('maintenance inspection date') ?></th>
                                    <td><?= h($building->maintenance_inspection_date) ?></td>

                                </tr>

                                </thead>
                            </table>
                        </div>
                        <a href="javascript:history.go(-1);"><button class="btn btn-secondary">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
