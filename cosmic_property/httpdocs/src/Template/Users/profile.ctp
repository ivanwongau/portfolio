
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
                            <h5 class="m-b-10">Profile</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item">Profile</li>
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
                        <div class="d-flex">
                            <h5>Users Profile</h5>
                            <div class="ml-auto p-2">
                                <?php echo $this->Html->link(__('Edit'), ['controller' => 'users', 'action' => 'profileedit', $user->id],
                                    array('class' => 'btn btn-primary', 'type' => 'button')) ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <td><?= h($user->email) ?></td>
                                    <th>Company Street</th>
                                    <td><?= h($user->company_street) ?></td>
                                </tr>
                                <tr>
                                    <th>First name</th>
                                    <td><?= h($user->first_name) ?></td>
                                    <th>Company City</th>
                                    <td><?= h($user->company_city) ?></td>
                                </tr>
                                <tr>
                                    <th>Last name</th>
                                    <td><?= h($user->last_name) ?></td>
                                    <th>Company State</th>
                                    <td><?= h($user->company_state) ?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?= h($user->phone) ?></td>
                                    <th>Company Country</th>
                                    <td><?= h($user->company_country) ?></td>
                                </tr>
                                <tr>
                                    <th>Company Name</th>
                                    <td><?= h($user->company_name) ?></td>
                                    <th>Company Postcode</th>
                                    <td><?= h($user->company_postcode) ?></td>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










