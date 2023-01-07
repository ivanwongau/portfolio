<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingsUser $buildingsUser
 */
?>
<?php 
    foreach ($rename as $row):
        if ($row['id']==24){
            $BuildingTransferPage_TransferRole = $row->name;
        }
        if ($row['id']==25){
            $BuildingTransferPage_TransferPerson = $row->name;
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
                            <h5 class="m-b-10">Access Control</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            <li class="breadcrumb-item"><a href="javascript:history.go(-1);">More Action</a></li>
                            <li class="breadcrumb-item">Transfer role</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <dl class="row">
            <p class="h1"><?=  $BuildingTransferPage_TransferRole ?></p>
            <p class="h5"><?=  $BuildingTransferPage_TransferPerson ?></p>
            <p class="h2">Your access details:</p>
        </dl>
        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Building Data:</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <td><?= h($building->property_name) ?></td>
                                    <th>Country</th>
                                    <td><?= h($building->country) ?></td>
                                </tr>
                                <tr>
                                    <th>Street</th>
                                    <td><?= h($building->street_name) ?></td>
                                    <th>Type</th>
                                    <td><?= h($building->building_type) ?></td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td><?= h($building->city) ?></td>
                                    <th>Ownership Type</th>
                                    <td><?= h($building->ownership_type) ?></td>
                                </tr>
                                <tr>
                                    <th>States</th>
                                    <td><?= h($building->state) ?></td>
                                    <th>Status</th>
                                    <td><?= h($building->status) ?></td>
                                </tr>
                                <tr>
                                    <th>Post Code</th>
                                    <td><?= h($building->postcode) ?></td>
                                    <th></th>
                                    <td></td>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <dl class="row">

            <?php if ($buildingsUser->access_level == 0) { ?>
                <dt class="col-sm-3">Access Level 0 or subscription management:</dt>
                <dd class="col-sm-9">
                    <li>-Can do access control which invite people to the building and change the access
                        level of another account
                        (level 2,3,4,5)
                    </li>
                    <li>-Set up subscription and payment</li>
                    <li>-View and Edit base building data</li>
                    <li>-Will be only 1 Subscription management</li>
                    <li>-Transfer subscriber role to another account</li>
                </dd>
            <?php } elseif ($buildingsUser->access_level == 1) { ?>
                <dt class="col-sm-3">Access Level 1:</dt>
                <dd class="col-sm-9">
                    <li>-Subscription management (payment and managing subscription)</li>
                    <li>-View data (base building data and field data)</li>
                    <li>-Edit base building data and field data</li>
                    <li>-Can do access control which invite people to the building and change the access level of
                        another
                        account
                    </li>
                    <li>-See the result of LTMP</li>
                    <li>-Transfer the admin role to another people</li>
                    <li>-Finalize the data</li>
                </dd>
            <?php } elseif ($buildingsUser->access_level == 2) { ?>
                <dt class="col-sm-3">Access Level 2:</dt>
                <dd class="col-sm-9">
                    <li>-View data (base building and field)</li>
                    <li>-Edit field data and base building data</li>
                    <li>-See the result of LTMP</li>
                    <li>-Invite from access level 3,4,5</li>
                    <li>-Transfer the access level 2 role to another account</li>
                    <li>-Finalize the data</li>
                </dd>
            <?php } elseif ($buildingsUser->access_level == 3) { ?>
                <dt class="col-sm-3">Access Level 3:</dt>
                <dd class="col-sm-9">
                    <li>-View data (base building and field)</li>
                    <li>-Edit field data and base building data</li>
                    <li>-See the result of LTMP</li>
                    <li>-Transfer the level 3 role to another person</li>
                </dd>
            <?php } ?>
        </dl>
        <div>
            <?= $this->Form->create($buildingsUser) ?>
            <form>
                <h3 class="mt-3">Transfer to:</h3>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?php echo $this->Form->control('user_id', ['class' => 'form-control', 'options' => $users]); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?php echo $this->Form->hidden('properties_id', ['class' => 'form-control', 'options' => $building, 'value' => $building]); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?php echo $this->Form->hidden('access_level', ['class' => 'form-control','value' => $buildingsUser->access_level]); ?>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="p-2">
                        <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()', 'class' => 'btn  btn-secondary']); ?>
                    </div>
                    <div class="ml-auto p-2">
                        <?= $this->Form->button('Submit', ['class' => 'btn  btn-primary', 'controller' => 'invited', 'action' => 'add']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </form>
        </div>
    </div>
</div>
