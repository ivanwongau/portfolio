<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingsUser $buildingsUser
 * @var \App\Model\Entity\Invited $invited
 */
?>
<?php 
    foreach ($rename as $row):
        if ($row['id']==22){
            $BuildingInvatePage_PersonHasAcc = $row->name;
        }
        if ($row['id']==23){
            $BuildingInvatePage_PersonWithNotAcc = $row->name;
        }
        if ($row['id']==34){
            $BuildingInvatePage_InvitePage = $row->name;
        }
        if ($row['id']==35){
            $BuildingInvatePage_InvitePageDesc = $row->name;
        }
        if ($row['id']==36){
            $BuildingInvatePage_AccessControlLevel0 = $row->name;
        }
        if ($row['id']==37){
            $BuildingInvatePage_AccessControlLevel1 = $row->name;
        }
        if ($row['id']==38){
            $BuildingInvatePage_AccessControlLevel2 = $row->name;
        }
        if ($row['id']==39){
            $BuildingInvatePage_AccessControlLevel3 = $row->name;
        }
        if ($row['id']==40){
            $BuildingInvatePage_AccessControlLevel4 = $row->name;
        }
        if ($row['id']==41){
            $BuildingInvatePage_AccessControlLevel5 = $row->name;
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
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:history.go(-1);">More Action</a>
                            </li>
                            <li class="breadcrumb-item">Invite Page</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <dl class="row">
            <p class="h1"><?= $BuildingInvatePage_InvitePage ?></p>
            <p class="lead">
                <?= $BuildingInvatePage_InvitePageDesc ?>
                <!-- You can give access a building to another account by inviting the account.<br>
                You can choose the access that the person would be able to do in the building. -->
            </p>
            <p class="h2">Access Level:</p>

            <dt class="col-sm-3">Access Level 0 or subscription management:</dt>
            <dd class="col-sm-9">
                <?=  nl2br($BuildingInvatePage_AccessControlLevel0) ?>
                <!-- <li>-Can do access control which invite people to the building and change the access
                    level of another account
                    (level 2,3,4,5)
                </li>
                <li>-Set up subscription and payment</li>
                <li>-View and Edit base building data</li>
                <li>-Will be only 1 Subscription management</li>
                <li>-Transfer subscriber role to another account</li> -->
            </dd>

            <dt class="col-sm-3">Access Level 1:</dt>
            <dd class="col-sm-9">
             <?=  nl2br($BuildingInvatePage_AccessControlLevel1) ?>
                <!-- <li>-Subscription management (payment and managing subscription)</li>
                <li>-View data (base building data and field data)</li>
                <li>-Edit base building data and field data</li>
                <li>-Can do access control which invite people to the building and change the access level of another
                    account
                </li>
                <li>-See the result of LTMP</li>
                <li>-Transfer the admin role to another people</li>
                <li>-Finalize the data</li> -->
            </dd>

            <dt class="col-sm-3">Access Level 2:</dt>
            <dd class="col-sm-9">
                <?=  nl2br($BuildingInvatePage_AccessControlLevel2) ?>
                <!-- <li>-View data (base building and field)</li>
                <li>-Edit field data and base building data</li>
                <li>-See the result of LTMP</li>
                <li>-Invite from access level 3,4,5</li>
                <li>-Transfer the access level 2 role to another account</li>
                <li>-Finalize the data</li> -->
            </dd>

            <dt class="col-sm-3">Access Level 3:</dt>
            <dd class="col-sm-9">
            <?=  nl2br($BuildingInvatePage_AccessControlLevel3) ?>
                <!-- <li>-View data (base building and field)</li>
                <li>-Edit field data and base building data</li>
                <li>-See the result of LTMP</li>
                <li>-Transfer the level 3 role to another person</li> -->
            </dd>

            <dt class="col-sm-3">Access Level 4:</dt>
            <dd class="col-sm-9">
                <?=  nl2br($BuildingInvatePage_AccessControlLevel4) ?>
                <!-- <li>-See the result of LTMP</li>
                <li>-Remove me from this building</li>
                <li>-View field data</li>
                <li>-Manage the subscription (payment and managing subscription)</li> -->
            </dd>

            <dt class="col-sm-3">Access Level 5:</dt>
            <dd class="col-sm-9">
                <?=  nl2br($BuildingInvatePage_AccessControlLevel5) ?>
                <!-- <li>-See the result of LTMP</li>
                <li>-Remove me from this building</li> -->
            </dd>

        </dl>

        <?= $this->Form->create($buildingsUser) ?>
        <form>
            <hr>
            <h3 class="mt-3"><?= $BuildingInvatePage_PersonHasAcc ?></h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('user_id', ['class' => 'form-control', 'options' => $users]); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('property_id', ['class' => 'form-control', 'options' => $buildings]); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Access Level</label>
                    <?php if ($access_level == 1) {
                        echo $this->Form->select(
                            'access_level',
                            [
                                '0' => 'Subscription Management',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ],
                            array('type' => 'text', 'class' => 'form-control', 'empty' => 'choose one')
                        );
                    } else if ($access_level == 0) {
                        echo $this->Form->select(
                            'access_level',
                            [
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ],
                            array('type' => 'text', 'class' => 'form-control', 'empty' => 'choose one')
                        );
                    } else if ($access_level == 2) {
                        echo $this->Form->select(
                            'access_level',
                            [
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ],
                            array('type' => 'text', 'class' => 'form-control', 'empty' => 'choose one')
                        );
                    } ?>
                </div>
            </div>
            <div class="d-flex">
                <div class="ml-auto p-2">
                    <?= $this->Form->button(__('Invite'), array('type' => 'submit', 'class' => 'btn  btn-primary')) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </form>

        <?= $this->Form->create($invited, ['url' => '/invited/add']) ?>
        <form>
            <hr>
            <h3 class="mt-3"><?= $BuildingInvatePage_PersonWithNotAcc ?></h3>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('email', array('type' => 'text', 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('property_id', ['class' => 'form-control', 'options' => $buildings, 'id' => 'user']);    ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Access Level</label>
                    <?php if ($access_level == 1) {
                        echo $this->Form->select(
                            'access_level',
                            [
                                '0' => 'Subscription Management',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ],
                            array('type' => 'text', 'class' => 'form-control', 'empty' => 'choose one')
                        );
                    } else if ($access_level == 0) {
                        echo $this->Form->select(
                            'access_level',
                            [
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ],
                            array('type' => 'text', 'class' => 'form-control', 'empty' => 'choose one')
                        );
                    } else if ($access_level == 2) {
                        echo $this->Form->select(
                            'access_level',
                            [
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ],
                            array('type' => 'text', 'class' => 'form-control', 'empty' => 'choose one')
                        );
                    } ?>
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
