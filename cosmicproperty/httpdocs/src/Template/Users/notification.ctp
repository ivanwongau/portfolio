
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
                            <h5 class="m-b-10">Notification</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item">Notification</li>
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
                        <h5>Notification</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <h5>End Less Than 7 days</h5>
                            <?php if(!empty($slist0to7)){
                                foreach ($slist0to7 as $subscription): ?>
                                    <p>Building: <b style="color: #7267EF"><?= $subscription['property_name']?></b> subscription will end at
                                        <font color=red><?=$subscription['end_date'] ?></font> <br/></p>
                                <?php endforeach; }
                            else{ ?>
                                <p>None</p>
                            <?php }?>

                            <h5>End Less Than 14 days</h5>

                            <?php if(!empty($slist8to14)){
                                foreach ($slist8to14 as $subscription): ?>
                                    <p>Building: <b style="color: #7267EF"><?= $subscription['property_name']?></b> subscription will end at
                                        <font color=orange><?=$subscription['end_date'] ?></font> <br/></p>
                                <?php endforeach; }
                            else{ ?>
                                <p>None</p>
                            <?php }?>

                            <h5>End Less Than 30 days</h5>
                            <?php if(!empty($slist15to30)){
                                foreach ($slist15to30 as $subscription): ?>
                                    <p>Building: <b style="color: #7267EF"><?= $subscription['property_name']?></b> subscription will end at
                                            <font color=green><?=$subscription['end_date'] ?></font> <br/></p>
                                <?php endforeach; }
                            else{ ?>
                                <p>None</p>
                            <?php }?>

                            <h5>Subscription That Has Ended</h5>
                            <?php if(!empty($slistTerminated)){
                                foreach ($slistTerminated as $subscription): ?>
                                    <p>Building: <b style="color: #7267EF"><?= $subscription['property_name']?></b> subscription has ended at
                                            <font color=red><?=$subscription['end_date'] ?></font> <br/></p>
                                <?php endforeach; }
                            else{ ?>
                                <p>None</p>
                            <?php }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










