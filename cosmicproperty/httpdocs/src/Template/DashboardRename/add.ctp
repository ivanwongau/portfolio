<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardRename $dashboardRename
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
                            <h5 class="m-b-10"><?php echo $user->role ?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item">Not Authorized page</li>
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
                        <h3>Please contact the technical person help to add more records!</h3>
                    </div>
                    <div class="card-body table-border-style">
                        <p>Sorry you can not add the records yourself!</p>
                        <p>Please contact <b>zliu0082@student.monash.edu</b> to help you add records!</p>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()', 'class' => 'btn  btn-secondary']); ?>
    </div>
</div>











