





<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>


<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Property</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:history.go(-1);">More Action</a>
                            </li>
                            <li class="breadcrumb-item">Data Finalization</li>
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
                        <h5>
                            Data Finalization
                        </h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">

                            <div>
                                <h2><?= $building_status ?><br></h2>
                                <p>
                                    <b>The following fields will be lock after clicking the finalize button : </b>
                                    <br>
                                    <b>Field Data:</b>Item (Name), Quantity, Unit<br>
                                    <b>Base Building Data:</b>Full Address , Property Settlement Date, Year built, age of property, plan or subdivision number.<br>
                                    <b>Building Multi Ownership Data:</b>Strata plan number, strata plan registration date,
                                    number of lots, number of total liabilities, owner corporation number. <br>

                                </p>

                                <?= $this->Form->create($building) ?>

                                <div class="d-flex">
                                    <div class="p-2">
                                        <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()','class'=>'btn  btn-secondary']); ?>
                                    </div>
                                    <div class="ml-auto p-2">
                                        <?= $this->Form->button(__('Confirm'),array('type'=>'submit','class'=>'btn  btn-primary')) ?>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




















