

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
                            <h5 class="m-b-10"><?php echo $user->role?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item">Brief Explanation</li>
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
                        <h5>Brief Explanation</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <h2>Brief Explanation</h2>
                            <p>As you are the person who “created” this building, you will be given Access Level 1. Level 1 Access Control can:<br>
                            <ul>
                                <li>-Manage Subscriptions. (payment and managing subscription)</li>
                                <li>-View data (base building & field data)</li>
                                <li>-Edit base building & field data</li>
                                <li>-Invite existing Users to the building</li>
                                <li>-Invite non-existing Users to the building</li>
                                <li>-Control User Access Levels</li>
                                <li>-Transfer the Admin role (Level 1 Access) to another user (once that user has been authorized and has accepted the Admin role) – Process to be developed and discussed.</li>
                                <li>- Finalise the data</li>
                            </ul>
                            <?= $this->Form->create($buildingsUser) ?>
                            <?php
                            echo $this->Form->hidden('user_id', ['value' => $users]);
                            echo $this->Form->hidden('property_id', ['value' => $buildings]);
                            echo $this->Form->hidden('access_level',['value'=>1]);
                            ?>
                            <?= $this->Form->button(__('Continue'),array('type'=>'submit','class'=>'btn  btn-primary')) ?>
                            <?= $this->Form->end() ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>












