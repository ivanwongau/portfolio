<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry $enquiry
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
                            <h5 class="m-b-10">Admin</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript:history.go(-1);">Enquires</a></li>
                            <li class="breadcrumb-item">Enquires View</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Users Enquires</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <td><?= h($enquiry->name) ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= h($enquiry->temp_email) ?></td>
                                </tr>
                                <tr>
                                    <th>Topic</th>
                                    <td><?= h($enquiry->topic) ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?= h($enquiry->status) ?></td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><?= h($enquiry->date) ?></td>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Message</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">

                            <?= $this->Text->autoParagraph(h($enquiry->message)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:history.go(-1);"><button class="btn btn-secondary">Back</button></a>
    </div>
</div>

