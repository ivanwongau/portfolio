<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingsUser $buildingsUser
 */
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
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="javascript:history.go(-1);">Related User</a></li>
                            <li class="breadcrumb-item">Edit Access control</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <?= $this->Form->create($buildingsUser) ?>
            <!-- [ basic-table ] start -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Access control</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <?php echo $this->Form->control('user_id', ['class' => 'form-control', 'options' => $users]); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <?php echo $this->Form->hidden('property_id', ['class' => 'form-control', 'options' => $buildings]);    ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="access_level">Access Level</label>
                                    <?php if($user['role']=='admin'){
                                        echo $this->Form->select(
                                            'access_level',
                                            [
                                                '0' => 'Subscription Management',
                                                '1' => '1',
                                                '2' => '2',
                                                '3' => '3',
                                                '4' => '4',
                                                '5' => '5'
                                            ],
                                            array('id'=>'level','type' => 'text','onchange' => 'javascript:cge()', 'class' => 'form-control', 'empty' => 'choose one')
                                        );
                                    }
                                    elseif ($access_level == 1) {
                                        echo $this->Form->select(
                                            'access_level',
                                            [
                                                '0' => 'Subscription Management',
                                                '2' => '2',
                                                '3' => '3',
                                                '4' => '4',
                                                '5' => '5'
                                            ],
                                            array('id'=>'level','type' => 'text','onchange' => 'javascript:cge()', 'class' => 'form-control', 'empty' => 'choose one')
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
                                            array('id'=>'level','type' => 'text','onchange' => 'javascript:cge()', 'class' => 'form-control', 'empty' => 'choose one')
                                        );
                                    } else if ($access_level == 2) {
                                        echo $this->Form->select(
                                            'access_level',
                                            [
                                                '3' => '3',
                                                '4' => '4',
                                                '5' => '5'
                                            ],
                                            array('id'=>'level','type' => 'text', 'onchange' => 'javascript:cge()','class' => 'form-control', 'empty' => 'choose one')
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

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Access Level Features</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">

                            <h3 id="total">Access level:</h3><br>
                            <h4 id="authority1"></h4>
                            <h4 id="authority2"></h4>
                            <h4 id="authority3"></h4>
                            <h4 id="authority4"></h4>
                            <h4 id="authority5"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function cge() {
                var level = document.getElementById('level');
                var sid = level.selectedIndex;
                var num=level[sid].value;
                if (num == 2){
                    document.getElementById('total').innerHTML = 'Access level: '+ num;
                    document.getElementById('authority1').innerHTML = '-View data (base building and field)';
                    document.getElementById('authority2').innerHTML = '-Edit field data and base building data';
                    document.getElementById('authority3').innerHTML = '-See the result of LTMP';
                    document.getElementById('authority4').innerHTML = '-Transfer the access level 2 role to another account';
                    document.getElementById('authority5').innerHTML = '-Finalize the data';
                }
                else if(num==3){
                    document.getElementById('total').innerHTML = 'Access level: '+ num;
                    document.getElementById('authority1').innerHTML = '-View data (base building and field)';
                    document.getElementById('authority2').innerHTML = '-Edit field data and base building data';
                    document.getElementById('authority3').innerHTML = '-See the result of LTMP';
                    document.getElementById('authority4').innerHTML = '-Transfer the level 3 role to another person';
                    document.getElementById('authority5').innerHTML ='';
                }
                else if(num==4){
                    document.getElementById('total').innerHTML = 'Access level: '+ num;
                    document.getElementById('authority1').innerHTML = '-See the result of LTMP';
                    document.getElementById('authority2').innerHTML = '-Remove me from this building';
                    document.getElementById('authority3').innerHTML = '-View field data';
                    document.getElementById('authority4').innerHTML = '-Manage the subscription (payment and managing subscription)';
                    document.getElementById('authority5').innerHTML ='';
                }
                else if(num==5){
                    document.getElementById('total').innerHTML = 'Access level: '+ num;
                    document.getElementById('authority1').innerHTML = '-See the result of LTMP';
                    document.getElementById('authority2').innerHTML = '-Remove me from this building';
                    document.getElementById('authority3').innerHTML = '';
                    document.getElementById('authority4').innerHTML = '';
                    document.getElementById('authority5').innerHTML ='';
                }
                else if(num==0){
                    document.getElementById('total').innerHTML = 'Access level: '+'Subscription Management';
                    document.getElementById('authority1').innerHTML = '-Can do access control which invite people to the building and change the access level of another account (level 2,3,4,5)';
                    document.getElementById('authority2').innerHTML = '-Set up subscription and payment';
                    document.getElementById('authority3').innerHTML = '-View and Edit base building data';
                    document.getElementById('authority4').innerHTML = '-Transfer subscriber role to another account';
                    document.getElementById('authority5').innerHTML = '';
                }
                else if(num==1){
                    document.getElementById('total').innerHTML = 'Access level: '+'1';
                    document.getElementById('authority1').innerHTML = '-Can do access control which invite people to the building and change the access level of another account (level 0,2,3,4,5)';
                    document.getElementById('authority2').innerHTML = '-Set up subscription and payment';
                    document.getElementById('authority3').innerHTML = '-View and Edit base building data and field data';
                    document.getElementById('authority4').innerHTML = '-Finalize the data and see result of LTMP';
                    document.getElementById('authority5').innerHTML = '-Transfer subscriber role to another account';
                }
            }
        </script>
