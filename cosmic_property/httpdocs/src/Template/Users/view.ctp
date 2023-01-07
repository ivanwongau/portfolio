<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry[]|\Cake\Collection\CollectionInterface $enquiries
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
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
                            <h5 class="m-b-10">Users</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'index']) ?>">Users</a></li>
                            <li class="breadcrumb-item">Users View</li>
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
                        <h5>Users Information</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td scope="row"><?= __('Email') ?></td>
                                        <th><?= h($userData->email) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('First Name') ?></td>
                                        <th><?= h($userData->first_name) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('Last Name') ?></td>
                                        <th><?= h($userData->last_name) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('Phone') ?></td>
                                        <th><?= h($userData->phone) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('Company Name') ?></td>
                                        <th><?= h($userData->company_name) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('Company Street') ?></td>
                                        <th><?= h($userData->company_street) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('Company City') ?></td>
                                        <th><?= h($userData->company_city) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('Company State') ?></td>
                                        <th><?= h($userData->company_state) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('Company Country') ?></td>
                                        <th><?= h($userData->company_country) ?></th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= __('Company Postcode') ?></td>
                                        <th><?= h($userData->company_postcode) ?></th>
                                    </tr>
                                    <thead>
                            </table>

                        </div>
                        </table>
                        <a href="javascript:history.go(-1);"><button class="btn btn-secondary">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>