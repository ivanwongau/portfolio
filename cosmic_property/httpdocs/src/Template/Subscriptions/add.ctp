<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>
<?php 
    foreach ($rename as $row):
        if ($row['id']==16){
            $AddNewSubscription_AddNewSubscription = $row->name;
        }
        if ($row['id']==17){
            $AddNewSubscription_Building = $row->name;
        }
        if ($row['id']==18){
            $AddNewSubscription_CommencementDate = $row->name;
        }
        if ($row['id']==19){
            $AddNewSubscription_ChooseSubscriptionYear = $row->name;
        }
        if ($row['id']==20){
            $AddNewSubscription_Price = $row->name;
        }
    endforeach;                             
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
                            <h5 class="m-b-10">Subscription</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:history.go(-1);">More Action</a>
                            </li>
                            <li class="breadcrumb-item">Add Subscription</li>
                        </ul>

                    </div>

                </div>

            </div>
        </div>
        <h4 class="mt-5"><?= $AddNewSubscription_AddNewSubscription ?></h4>

        <hr>
        <?php echo $this->Form->create($subscription, array('class' => 'needs-validation')) ?>
        <form>
            <div class="row">
                <div class="form-group">
                    <?php echo $this->Form->control('building_id', ['option' => $buildings, 'class' => 'form-control','label' => $AddNewSubscription_Building,]) ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->control("commencement_date", array('type' => 'date', 'class' => 'form-control date', 'id' => 'example-datemax',
                        'max' => $maxDate, 'min' => $minDate, 'required' => true,'label'=>$AddNewSubscription_CommencementDate)) ?>
                </div>
                <!--                <div class="form-group">-->
                <!--                    <label for="property_date">Subscription Commencement Date</label>-->
                <!--                    <input type="date" class="form-control" id="commencement_date" name="commencement_date" required max="--><?php //$today
                                                                                                                                                    ?>
                <!--">-->
                <!--                </div>-->

                <div class="form-group">
                    <label for="year"> <?php 
                    
                            foreach ($rename as $row):
                                if ($row['id']==19){
                                    // echo "<tr><td>".$row->id."</td>";
                                    echo "<td>".$row->name."</td>";
                                }
                            endforeach;
                        
                    
                    ?></label>
                    <?php echo $this->Form->select('period', [
                        '1' => '1 year',
                        '2' => '2 year',
                        '3' => '3 year',
                        '4' => '4 year',
                        '5' => '5 year'
                    ], ['id' => 'year', 'onchange' => 'javascript:cge()', 'class' => 'form-control']); ?>
                </div>
            </div>
            <div class="row">
                <?php
                echo $this->Form->hidden('forecast_period_display');
                echo $this->Form->hidden('forecast_in_advance'); ?>
                <h5>The subscription price to Long Term Maintenance Plan is $
                    <?php foreach ($rename as $row):
                                if ($row['id']==20){
                                    $AddNewSubscription_Price = $row->name;
                                    echo "<td>".$row->name."</td>";
                                    
                                }
                            endforeach; ?>/year.</h5>
                <h3 id="totalPrice">Final Price : <?= $AddNewSubscription_Price ?> </h3><br>
            </div>
            <div class="d-flex">
                <div class="p-2">
                    <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()', 'class' => 'btn  btn-secondary']); ?>
                </div>
                <div class="ml-auto p-2">
                    <?php echo $this->Form->button(__('Check out'), ['type' => 'submit', 'class' => 'btn  btn-primary', $buildings]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>

        </form>
    </div>
</div>


<script>
    function cge() {
        var year = document.getElementById('year');
        var sid = year.selectedIndex;
        var tp = year[sid].value * <?= $AddNewSubscription_Price ?>;
        document.getElementById('totalPrice').innerHTML = 'Final Price : $' + tp;
    }
</script>
