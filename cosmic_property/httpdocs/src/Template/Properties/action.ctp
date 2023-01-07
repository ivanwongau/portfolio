<?php
    foreach ($rename as $row):
        if ($row['id']==26){
            $MoreAction_MoreAction = $row->name;
        }
        if ($row['id']==27){
            $MoreAction_BuildingDetails = $row->name;
            }

        if ($row['id']==28){
            $MoreAction_Postcode = $row->name;
        }
        if ($row['id']==29){
            $MoreAction_BaseBuildingDataDesc = $row->name;
        }
        if ($row['id']==30){
            $MoreAction_HOFDataDesc = $row->name;
        }
        if ($row['id']==31){
            $MoreAction_HOSDataDesc = $row->name;
        }
        if ($row['id']==32){
            $MoreAction_HOACDesc = $row->name;
        }
        if ($row['id']==33){
            $MoreAction_HODFDesc = $row->name;
        }

    endforeach;
?>
<div class="pc-container">
    <div class="pcoded-content">
        <div id="accordion">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Buildings</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                                </li>
                                <li class="breadcrumb-item">More Action</li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>

            <div class=" d-flex mt-4 p-2">
                <div class="p-2">
                    <?php echo $this->Html->link(
                        '<button class="btn btn-secondary"><span>Go to Building Dashboard</span></button>',
                        ['controller' => 'Properties', 'action' => 'dashboard', $buiID],
                        ['escape' => false]
                    ); ?>
                </div>

               <?php

                    if ($access_level == 1) { ?>
                <div class="ml-auto p-2">
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $buiData->id],
                        ['class' => 'icon feather icon-trash-2 ml-2 f-16  btn btn-danger', 'title' => "Delete",
                            'confirm' => __('Are you sure you want to delete this building?  All info related to this building will be permanently deleted!', $buiData->property_name)]) ?>
                </div>


                <?php } ?>

            </div>

            <dl class="row">
                <p class="h1"><?= $MoreAction_MoreAction ?></p>
                <p class="h2"></p>
            </dl>

            <div class="row">
                <!-- [ basic-table ] start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><?= $MoreAction_BuildingDetails ?></h3>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Property Name</th>
                                        <td><?= h($buiData->property_name) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Street Number</th>
                                        <td><?= h($buiData->street_number) ?></td>
                                        <th>Street Name</th>
                                        <td><?= h($buiData->street_name) ?></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><?= h($buiData->city) ?></td>
                                        <th>State</th>
                                        <td><?= h($buiData->state) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $MoreAction_Postcode ?></th>
                                        <td><?= h($buiData->postcode) ?></td>
                                        <th>Country</th>
                                        <td><?= h($buiData->country) ?></td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Base Building Data-->
            <?php if ($user->role == 'admin' || $access_level < 4) { ?>
                <div class="card">
                    <!--    Edit base building data-->
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                Base Building Data
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <p><?= $MoreAction_BaseBuildingDataDesc ?></p>
                            <?php echo $this->Html->link('View', ['action' => 'view', $buiID, $access_level],
                                array('class' => 'btn btn-primary', 'type' => 'button')) ?>
                            <?php if ($user->role == 'admin' || $access_level < 4) { ?>
                                <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $buiID],
                                    array('class' => 'btn btn-primary', 'type' => 'button')) ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!--edit field data of a building or get the result of ltmp-->
            <?php if ($user->role == 'admin' || ($access_level <= 4 && $access_level != 0)) { ?>
                <div class="card">
                    <div class="card-header" id="headingTwo">

                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseOne">
                                Field Data and Reports
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <p><?= $MoreAction_HOFDataDesc ?></p>
                            <?= $this->Html->link(__('Dashboard'), ['action' => 'dashboard', $buiID],
                                array('class' => 'btn btn-primary', 'type' => 'button')) ?>
                        </div>
                    </div>
                </div>
            <?php } elseif ($access_level > 3) {
                echo $this->Html->link(__('Report Download'), ['action' => 'report_download', $buiID],
                    array('class' => 'btn btn-primary', 'type' => 'button'));
            } ?>

            <!--subscription thing-->
            <?php if ($user->role == 'admin' || $access_level == 4 || $access_level == 0 || $access_level == 1) {
                if ($buiData->status == 'non active') {
                    ?>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                    Subscription
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordion">
                            <div class="card-body">
                                <p><?= $MoreAction_HOSDataDesc ?></p>
                                <?php echo $this->Html->link('Subscribe', ['controller' => 'subscriptions', 'action' => 'add', $buiID],
                                    array('class' => 'btn btn-primary', 'type' => 'button')); ?>
                            </div>
                        </div>
                    </div>
                <?php } elseif ($buiData->status == 'active') {
                    ?>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                    Subscription
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordion">
                            <div class="card-body">
                                <p><?= $MoreAction_HOSDataDesc ?></p>
                                <?php echo $this->Html->link(__('Subscription'), ['controller' => 'subscriptions',
                                    'action' => 'view', $buiID], array('class' => 'btn btn-primary', 'type' => 'button')); ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>

            <!--invite-->
            <?php if ($user->role == 'admin' || $access_level <= 2) { ?>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                Access Control
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <p><p><?= $MoreAction_HOACDesc ?></p></p>
                            <?php echo $this->Form->postLink(__('Invite'), ['controller' => 'PropertiesUsers', 'action' => 'invite', $buiID,
                                $access_level], array('class' => 'btn btn-primary', 'type' => 'button')) ?>

                            <?= $this->Html->link(__('Related User'), ['controller' => 'PropertiesUsers',
                                'action' => 'relateduser', $buiID], array('class' => 'btn btn-primary', 'type' => 'button')); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!--Finalize the Data-->
            <?php if (($user->role == 'admin' || $access_level == 1 || $access_level == 2)&&$buiData->finalized=='false') { ?>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">
                                Data Finalization
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body">
                            <P><?= nl2br($MoreAction_HODFDesc) ?></P>
                            <!-- <p>The user accepts that the data is correct and ready for finalisation. After finalisation,
                                some data fields will be locked and un-editable.
                            <ul>
                                <li>
                                    Item Name
                                </li>
                                <li>
                                    Item Quantity
                                </li>
                                <li>
                                    Item Unit
                                </li>
                            </ul>
                            and base building data.
                            <ul>
                                <li>
                                    Full Address
                                </li>
                                <li>
                                    Owners Corporation number (if applicable)
                                </li>
                                <li>
                                    Plan of Sub-Division number (POS#)
                                </li>
                                <li>
                                    Strata Plan Number (if applicable)
                                </li>
                                <li>
                                    Strata plan registration date (if applicable)
                                </li>
                                <li>
                                    Year Built
                                </li>
                                <li>
                                    Age of Property / Building (years)
                                </li>
                                <li>
                                    Number of Lots (If applicable)
                                </li>
                                <li>
                                    Number of Total Liabilities (If applicable)
                                </li>
                            </ul>
                            Finalisation is a requirement
                            to viewing results of calculations and reports.</p> -->
                            <?php if ($buiData->status == 'active' && $buiData->finalized == 'false') {
                                echo $this->Html->link(__('Finalize'), ['action' => 'dataFinalization', $buiData->id],
                                    array('class' => 'btn btn-primary', 'type' => 'button'));
                            } elseif ($buiData->status == 'non active' && $buiData->finalized == 'false') {
                                echo $this->Html->link('Subscribe', ['controller' => 'subscriptions', 'action' => 'add', $buiID],
                                    array('class' => 'btn btn-primary', 'type' => 'button'));
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>


            <!--Transfer your role to another account or remove me from this building-->

            <?php if ($user->role !='admin' &&$access_level <= 3) { ?>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix"
                                    aria-expanded="false" aria-controls="collapseSix">
                                Transfer your role
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">
                            <p>Transfer your access level to this building to another building related user. Once the transfer is authorized and accepted, you will have no access to this building.</p>
                            <?= $this->Html->link(__('Transfer'), ['controller' => 'PropertiesUsers',
                                'action' => 'transfer', $buiID],
                                array('class' => 'btn btn-primary', 'type' => 'button')) ?>
                        </div>
                    </div>
                </div>
            <?php } elseif ($access_level >= 4) { ?>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix"
                                    aria-expanded="false" aria-controls="collapseSix">
                                Delete
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">
                            <p>Delete your access to this building/ remove me from this building.</p>
                            <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'PropertiesUsers', 'action' => 'delete', $buiID]
                                , ['confirm' => __('Are you sure you want to remove yourself from this building
             # {0}?', $buiID)], array('class' => 'btn btn-primary', 'type' => 'button')) ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>




