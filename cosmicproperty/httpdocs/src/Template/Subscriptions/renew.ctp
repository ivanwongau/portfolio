
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>

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
                            <h5 class="m-b-10">Subscription</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'properties', 'action' => 'buildinglist']) ?>">Buildings</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:history.go(-1);">Subscription View</a>
                            </li>
                            <li class="breadcrumb-item">Extend Subscription</li>
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
                        <h5>Extend Subscription</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <?= $this->Form->create($subscription) ?>
                            <fieldset>
                                <legend><?= __('Renew Subscription') ?></legend>
                                <?php
                                echo $this->Form->hidden('property_id', ['option' => $buildings ]);

                                echo $this->Form->hidden('commencement_date');
                                echo $this->Form->hidden('end_date');?>
                                <label for="year" >Choose subscription year</label>
                                <?php echo $this->Form->select('period',[
                                    '1' => '1 year',
                                    '2' => '2 year',
                                    '3' => '3 year',
                                    '4' => '4 year',
                                    '5' => '5 year'],['id'=>'year','onchange'=>'javascript:cge()','class'=>'form-control']);?>
                                <?php
                                echo $this->Form->hidden('forecast_period_display');
                                echo $this->Form->hidden('forecast_in_advance');?>
                            </fieldset>
                            <br>
                            <h5>The subscription price to Long Term Maintenance Plan is $150/year.</h5>
                            <h3 id="totalPrice">Final Price : $150</h3><br>

                            <div class="d-flex">
                                <div class="p-2">
                                    <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()','class'=>'btn  btn-secondary']); ?>
                                </div>
                                <div class="ml-auto p-2">
                                    <?= $this->Form->button(__('Check out'),['class'=>'btn  btn-primary',$buildings]) ?>
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














<script>

    function cge(){
        var year=document.getElementById('year');
        var sid=year.selectedIndex;
        var tp=year[sid].value*150;
        document.getElementById('totalPrice').innerHTML ='Final Price : $'+tp;
    }


</script>




