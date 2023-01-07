<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building[]|\Cake\Collection\CollectionInterface $buildings
 * @var \App\Model\Entity\User $user
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
                            <h5 class="m-b-10"><?= __('Buildings') ?></h5>


                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item">Building List</li>
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
                        <h3 style="float: left">
                        <?php
                                foreach ($rename as $row):
                                    if ($row['id']==1){
                                        // echo "<tr><td>".$row->id."</td>";
                                        echo "<td>".$row->name."</td>";
                                    }
                                endforeach;
                            ?>
                            </h3>
                        <div class="search-container input-group-prepend">
                            <?php echo $this->Form->create(null,['type'=>'get'])?>
                            <div class="input-group search-container" >
                                <input id="key" name="key" value="<?php echo $this->request->getQuery('key')?>" class="form-control ">
                                <div class="input-group-prepend">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> ',['escape'=>false,'class'=>'btn btn-primary input-group-text','type'=>'submit'])?>

                                </div>
                            </div>

                            <?php echo $this->Form->end()?>
                        </div>
<br>
                        <br>

                       
                        
                        <?php echo $this->Html->link(    
                                'Add New Building',
                            ['controller' => 'properties', 'action' => 'add'],
                            ['class' => 'btn btn-success btn-round','stlye'=>'float:left']
                        ); ?>

                            <!-- <div class="utility-btn-3">
                                        <a href=<?= $this->Url->build(['controller' => 'ItemMaintenances', 'action' => 'view', $$maintenance->id]); ?> 
                                        class="button btn-md greenButtons">View</a>
                                    </div> -->
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="actions"
                                        style="text-align: left;color: #7267EF"><?= __('Actions') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('property_name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('street_name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('building_type') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('ownership_type') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                    <th scope="col" style="color: #7267EF">Access Level</th>

                                </tr>
                                </thead>
                                <?php foreach ($buildings as $building) : ?>
                                <tbody>
                                    <tr>
                                        <td class="actions" style="">
                                            <!--                            Dashboard button-->
                                            <?php if ($user->role == 'admin') { ?>
                                                <a href=" <?= $this->Url->build(['action' => 'dashboard', $building->id]) ?>"><i
                                                        class="icon feather icon-clipboard  f-16  text-success"title="dashboard" onclick="getBuildingDashboardDetails('<?=$building->property_name?>', '0')"></i></a>
                                            <?php } else if ($building->_matchingData['PropertiesUsers']->access_level <= 4 &&
                                                $building->_matchingData['PropertiesUsers']->access_level !=0) { ?>
                                                <a href=" <?= $this->Url->build(['action' => 'dashboard', $building->id]) ?>"
                                                   onclick="getBuildingDashboardDetails('<?=$building->property_name?>', '<?=$building->_matchingData['PropertiesUsers']->access_level?>')"><i
                                                        class="icon feather icon-clipboard f-16  text-success"title="dashboard"></i></a>
                                            <?php } ?>

                                            <!--                    More Actions-->
                                            <a href=" <?= $this->Url->build(['action' => 'action', $building->id]) ?>"><i
                                                    class="icon feather icon-more-horizontal ml-2 f-16  text-success" title="more action"></i></a>

                                            <!--                    view button-->

                                            <?php if ($user->role == 'admin') { ?>
                                                <a href=" <?= $this->Url->build(['action' => 'view', $building->id]) ?>"><i
                                                        class="icon feather icon-eye ml-2 f-16  text-success" title="view"></i></a>
                                            <?php } else if ($building->_matchingData['PropertiesUsers']->access_level < 4) { ?>
                                                <a href=" <?= $this->Url->build(['action' => 'view', $building->id]) ?>"><i
                                                        class="icon feather icon-eye ml-2 f-16  text-success" title="view"></i></a>
                                            <?php } ?>

                                             <!--                    delete button-->
                                            
                                            <?php if ($user->role == 'admin') { ?>
                                                <?= $this->Form->postLink(
                                                    '',
                                                    ['action' => 'delete', $building->id],
                                                    ['class' => 'icon feather icon-trash-2 ml-2 f-16  text-danger', 
                                                    
                                                        'confirm' => __('Are you sure you want to delete # {0}?, 
                                                    Once you click yes,all info will be deleted!', $building->id)]) 
                                                ?>

                                            <?php } else if ($building->_matchingData['PropertiesUsers']->access_level == 1) { ?>
                                                <?= $this->Form->postLink(
                                                    '',
                                                    ['action' => 'delete', $building->id],
                                                    ['class' => 'icon feather icon-trash-2 ml-2 f-16  text-danger', 
                                                    
                                                        'confirm' => __('Are you sure you want to delete # {0}?, 
                                                    Once you click yes,all info will be deleted!', $building->id)]) 
                                                ?>

                                                              <?php } ?>

                                        </td>
                                        <td><?= h($building->property_name) ?></td>
                                        <td><?= h($building->street_name) ?></td>
                                        <td><?= h($building->city) ?></td>
                                        <td><?= h($building->state) ?></td>
                                        <td><?= h($building->country) ?></td>
                                        <td><?= h($building->building_type) ?></td>
                                        <td><?= h($building->ownership_type) ?></td>
                                        <?php if ($building->status == 'non active') { ?>
                                            <td style="color: red"><b><?= h($building->status) ?></b></td>
                                        <?php } else { ?>
                                            <td><?= h($building->status) ?></td>
                                        <?php } ?>
                                        <td><?php if($user->role=='admin'){
                                                echo "You're the admin";
                                            }else{
                                            echo $building->_matchingData['PropertiesUsers']->access_level;} ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="paginator">
                        <ul class="pagination pagination-circle justify-content-center flex">
                            <?= $this->Paginator->prev("<<") ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(">>") ?>
                        </ul>
                        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                    </div>

        

    </div>
</div>

<script>
    function getBuildingDashboardDetails(buildingName, userAccess) {
        localStorage.setItem("buildingName", buildingName);
        localStorage.setItem("userAccess", userAccess)
    }
</script>

