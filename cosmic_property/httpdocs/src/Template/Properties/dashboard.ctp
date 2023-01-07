<?php

// use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

use Cake\ORM\TableRegistry;

$psfuQuery = TableRegistry::getTableLocator()->get('PropertyStorageFoldersUsers');

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Properties $properties
 * @var \App\Model\Entity\PropertyImages $propertyImages
 */
?>
<?php if ($user->role != 'admin') : ?>
    <p id="access-level" style="display:none;"><?= $access_level ?></p>

<?php endif; ?>
<?php
foreach ($rename as $row):
    if ($row['id'] == 44) {
        $DashboardMainPage_TotalItems = $row->name;
    }
    if ($row['id'] == 45) {
        $DashboardMainPage_TotalItemsDueThisYear = $row->name;
    }
    if ($row['id'] == 46) {
        $DashboardMainPage_PropertyReport = $row->name;
    }
    if ($row['id'] == 47) {
        $DashboardMainPage_NotFinalised = $row->name;
    }

    if ($row['id'] == 48) {
        $DashboardMainPage_Includes = $row->name;
    }
    if ($row['id'] == 49) {
        $DashboardMainPage_OwnerType = $row->name;
    }
    if ($row['id'] == 50) {
        $DashboardMainPage_OwnerCorpNumber = $row->name;
    }
    if ($row['id'] == 51) {
        $DashboardMainPage_NumberOfLots = $row->name;
    }
    if ($row['id'] == 52) {
        $DashboardMainPage_NumberOfLotLiabilities = $row->name;
    }
    if ($row['id'] == 53) {
        $DashboardMainPage_StrataPlanNumber = $row->name;
    }
    if ($row['id'] == 54) {
        $DashboardMainPage_PlanRegistrationDate = $row->name;
    }

    if ($row['id'] == 55) {
        $DashboardMainPage_PropertyInformation = $row->name;
    }
    if ($row['id'] == 56) {
        $DashboardMainPage_Calendar = $row->name;
    }
    if ($row['id'] == 57) {
        $DashboardMainPage_ItemMaintenanceList = $row->name;
    }

    if ($row['id'] == 58) {
        $DashboardMainPage_LevelsLocations = $row->name;
    }

endforeach;
?>

<div class="property_view content pc-container">

    <div class="section-a">
        <div class="box box1 card">
            <div class="box1-content">
                <h1><?= $property->property_name ?></h1>
                <?php if ($user->role != 'admin') : ?>
                    <h2>Access Level <?= $access_level ?></h2>

                <?php endif; ?>

                <h3><?= " $property->street_number $property->street_name, $property->city, $property->state" ?></h3>
            </div>


        </div>
        <div class="box box2 card">
            <div class="box2-content">
                <i class="fas fa-boxes fa-2x"></i>
                <div class="info-content ">
                    <h2><?= $DashboardMainPage_TotalItems ?></h2>
                    <h3><?= count($item_data) ?></h3>
                </div>

            </div>

        </div>
        <div class="box box3 card">
            <div class="box3-content">
                <i class="fas fa-tools fa-2x"></i>
                <div class="info-content">
                    <h2><?= $DashboardMainPage_TotalItemsDueThisYear ?></h2>
                    <?php
                    $count = 0;
                    foreach ($item_data as $item) {
                        if ($item['year_due'] == 1) {
                            $count += 1;
                        }
                    }
                    ?>
                    <h3><?= $count ?></h3>
                </div>

            </div>


        </div>
        <div class="box box4 card">
            <div class="image-slider">


                <div class="slideshow-container">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php $i = 0; ?>
                            <?php foreach ($property->property_images as $propertyImage) : ?>

                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;
                                $i++; ?>"></li>
                            <?php endforeach; ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php $j = 0; ?>
                            <?php foreach ($property->property_images as $propertyImage) : ?>

                                <div class="carousel-item <?php if ($j == 0) {
                                    echo "active";
                                    $j++;
                                } ?>">
                                    <?= $this->Html->image($propertyImage->image_name) ?>

                                </div>

                            <?php endforeach; ?>


                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>


                </div>
                <div class="slider-btn">
                    <?= $this->Html->link('<button class="table-btn"><span>Add Images</span></button>', ['action' => 'propertyToPropertyImage', $property->id, $property->property_name], ['escape' => false, 'class' => 'property-image-add']) ?>
                    <?= $this->Html->link('<button class="table-btn"><span>View Images</span></button>', ['controller' => 'PropertyImages', 'action' => 'view', $property->id], ['escape' => false, 'class' => 'property-image-view']) ?>
                </div>
            </div>
        </div>
        <div class="box box5 card">
            <div class="report-header">
                <h3 class="header-title"><?= $DashboardMainPage_PropertyReport ?></h3>
                <!-- <?php
                $time = Time::now();
                $result = $commencement_date;
                ?> -->
                <?php if ($property->finalized == "true" && $property->status == 'active') : ?>
                    <?= $this->Html->link('<button class="table-btn"><span>View Report</span></button>', ['action' => 'reportDownload', $property->id], ['escape' => false]) ?>
                <?php endif; ?>
                <?php if ($property->finalized == "false") :echo $DashboardMainPage_NotFinalised ?>
                    <!-- <h6>The property has not yet been finalised. To finalise property, please go to Building List or Click
                       the Building Icon on the left.</h6> -->
                <?php endif; ?>
            </div>

            <div class="report-body">
                <?= nl2br($DashboardMainPage_Includes) ?>
            </div>

        </div>

    </div>


    <!-- Section File Storage -->
    <div class="section-fs">
        <div class="property-fs card">
            <?php if ($totalFileStorageSize > 0.5) { ?>
                <div class="alert alert-danger">
                    <center>
                        <p><b>WARNING</b>: The total file storage for this property has exceeded 0.5 GB.</p>
                        <p>Please proceed in caution when uploading new files and inform a building manager regarding this issue.</p>
                    </center>
                </div>
            <?php } ?>

            <div class="table-header">
                <h3 class="header-title">File Storage (<span id="totalFileStorageSize")"><?= $totalFileStorageSize ?></span>/0.5 GB Max)</h3>
                <?= $this->Html->link('<button class="table-btn"><span>Add Folder</span></button>', ['controller' => 'PropertyStorageFolders', 'action' => 'add', $currentprop_id], ['escape' => false]) ?>
            </div>

            <div class="row">
                <?php foreach ($storageFolders as $storageFolder) : ?>
                    <div class="col-md-3">
                    <span style="cursor: pointer;"
                          onclick="clickRedirect('<?= $this->URL->build(['controller' => 'PropertyStorageFolders', 'action' => 'index', $storageFolder->id, $currentprop_id]) ?>')">
                        <i class="far fa-folder-open"></i>
                        <?= h($storageFolder->folder_name) ?>
                    </span>

                        <!-- If the user is of managerial access for the folder -->
                        <?php
                        $userRole = $user->role;
                        $psfu = $psfuQuery->find()->where(['property_storage_folder_id' => $storageFolder->id, 'user_id' => $user->id])->first();

                        $psfu_access_level = 0;
                        if ($psfu != null) {
                            $psfu_access_level = $psfu->folder_access_level;
                        }

                        if ($userRole == 'admin' || $access_level == 0 || $access_level == 1 || $psfu_access_level == 3) {
                            ?>

                            <div class="dropdown" style="float: right; margin-left: auto; width: 10%;">
                                <button type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        style="border: #F3F3F3; background-color: #F3F3F3;"
                                        aria-expanded="false">
                                <span>
                                    <i class="fas fa-ellipsis-h"
                                    ></i>
                                </span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="
                                <?= $this->URL->build(['controller' => 'PropertyStorageFolders', 'action' => 'edit', $storageFolder->id, $property->id]) ?>
                                ">Rename</a>

                                    <a class="dropdown-item" href="
                                <?= $this->URL->build(['controller' => 'PropertyStorageFoldersUsers', 'action' => 'index', $storageFolder->id, $property->id]) ?>
                                ">
                                        User Access
                                    </a>

                                    <a data-toggle="modal" data-target="#folder_delete_confirmation"
                                       class="dropdown-item" style="cursor:pointer;">
                                        Delete
                                    </a>

                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <!-- Section B -->
    <div class="section-b">
        <!-- Pie-Chart -->
        <div class="property-info card">
            <div class="table-header">
                <h3 class="header-title"><?= $DashboardMainPage_OwnerType ?></h3>
                <?php if ($is_multi == 'Add More') : ?>
                    <?= $this->Html->link('<button class="table-btn"><span>Add Multi Ownership</span></button>', ['controller' => 'PropertyMultiOwnerships', 'action' => 'add', $currentprop_id], ['escape' => false]) ?>
                <?php endif; ?>
                <?php if ($is_multi == 'Multi') : ?>
                    <span>
                    <?php

                    if ($user->role == 'admin'): ?>
                        <?= $this->Html->link('<button class="table-btn btn-sm"><span>Edit Info</span></button>', ['controller' => 'PropertyMultiOwnerships', 'action' => 'edit', $propertyMultiOwnership->first()->id, $property->id], ['escape' => false]) ?>
                    <?php endif; ?>

                    <?= $this->Html->link('<button class="table-btn btn-sm"><span>View/Edit Lots</span></button>', ['controller' => 'LotOwners', 'action' => 'edit', $propertyMultiOwnership->first()->id], ['escape' => false]) ?>
                </span>
                <?php endif; ?>
            </div>

            <div class="table-container">
                <?php if ($is_multi == 'Single Ownership Type') : ?>
                    <section id="multi_ownership_area">
                        <?php echo $is_multi ?>
                    </section>
                <?php endif; ?>
                <?php if ($is_multi == 'Multi') : ?>

                    <section id="multi_ownership_area">

                        <table class="property-info-table table-decoration">
                            <thead>
                            <tr>
                                <th scope="col"><b>Field</b></th>
                                <th scope="col"><b>Value</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><?= $DashboardMainPage_OwnerCorpNumber ?></td>
                                <td><?= h($propertyMultiOwnership->first()->owner_corp_num) ?></td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><?= $DashboardMainPage_NumberOfLots ?></td>
                                <td><?= h($propertyMultiOwnership->first()->Num_of_lot) ?></td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><?= $DashboardMainPage_NumberOfLotLiabilities ?></td>
                                <td> <?= h($propertyMultiOwnership->first()->Num_of_lot_liabilities) ?></td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><?= $DashboardMainPage_StrataPlanNumber ?></td>
                                <td> <?= h($propertyMultiOwnership->first()->strata_plan_number) ?></td>
                            </tr>
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><?= $DashboardMainPage_PlanRegistrationDate ?></td>
                                <td><?= h(date('d/m/Y', strtotime($propertyMultiOwnership->first()->plan_registration_date))) ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </section>
                <?php endif; ?>
            </div>
        </div>

        <!-- Property Information -->
        <div class="property-info card">
            <h3 class="header-title"><?= $DashboardMainPage_PropertyInformation ?></h3>
            <div class="table-container">
                <table class="property-info-table table-decoration">
                    <thead>
                    <tr>
                        <th scope="col"><b>Field</b></th>
                        <th scope="col"><b>Value</b></th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Building Type</td>
                        <td><?= h($property->building_type) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Ownership Type</td>
                        <td> <?= h($property->ownership_type) ?></td>
                    </tr>


                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Starting Balance
                        </td>
                        <td><?= h($property->starting_balance) ?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Interest Rate</td>
                        <td><?= h($property->interest_rate) * 100 ?>%</td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Inflation Rate</td>
                        <td><?= h($property->inflation_rate) * 100 ?>%</td>
                    </tr>

                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">GST</td>
                        <td><?= h($property->GST) * 100 ?>%</td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Contribution Safety Net</td>
                        <td><?= h($property->contribution_safety_net) * 100 ?>%</td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Commencement Date of Maintenance Plan</td>
                        <td><?= h(date('d/m/Y', strtotime($property->property_date))) ?></td>
                    </tr>
                    <?php if ($property->status == "active") : ?>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Commencement Date</td>
                            <td><?= h(date('d/m/Y', strtotime($subscriptions->commencement_date))) ?></td>
                        </tr>
                    <?php endif; ?>


                    </tbody>
                </table>
            </div>


        </div>

        <!-- Calendar -->
        <div class="calendar card">
            <h3 class="header-title"><?= $DashboardMainPage_Calendar ?></h3>
            <div class="calendar-container">

                <div id="v-cal">
                    <div class="vcal-header">
                        <button class="vcal-btn" data-calendar-toggle="previous">
                            <svg height="24" version="1.1" viewbox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z">
                                </path>
                            </svg>
                        </button>

                        <div class="vcal-header__label" data-calendar-label="month">
                            March 2017
                        </div>


                        <button class="vcal-btn" data-calendar-toggle="next">
                            <svg height="24" version="1.1" viewbox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="vcal-week">
                        <span>Mon</span>
                        <span>Tue</span>
                        <span>Wed</span>
                        <span>Thu</span>
                        <span>Fri</span>
                        <span>Sat</span>
                        <span>Sun</span>
                    </div>
                    <div class="vcal-body" data-calendar-area="month"></div>
                </div>

            </div>

        </div>
    </div>


    <!-- Section C -->
    <div class="section-c">
        <div class="item-maintenance card">
            <div class="table-header">
                <h5 class="header-title "><?= $DashboardMainPage_ItemMaintenanceList ?></h5>
                <?= $this->Html->link('<button class="table-btn"><span>View details</span></button>', ['controller' => 'ItemMaintenances', 'action' => 'index', $currentprop_id], ['escape' => false]) ?>
            </div>

            <div class="table-container">
                <table class="item-maintenance-table table-decoration " id="dataTable2">
                    <thead>
                    <tr>
                        <th class="border-top-0">ID</th>
                        <th class="border-top-0">Item Name</th>
                        <th class="border-top-0">Item Status</th>
                        <th class="border-top-0">Item Location</th>
                        <th class="border-top-0">Item proposal</th>
                        <th class="border-top-0">Potential Hazard</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($maintenance as $maintenance) : ?>
                        <div>
                            <tr style="cursor: pointer"
                                onclick="clickRedirect('<?= $this->URL->build(['controller' => 'ItemMaintenances', 'action' => 'edit', $maintenance->id]) ?>')">

                                <td>
                                    <?= h($maintenance->id) ?></td>
                                <td>
                                    <?= h($maintenance->item_name) ?></td>
                                <td>
                                    <?= h($maintenance->item_status) ?></td>
                                <td>
                                    <?= h($maintenance->item_location) ?></td>
                                <td>
                                    <?= h($maintenance->item_recommendation) ?></td>
                                <td>
                                    <?= h($maintenance->potential_hazard) ?></td>
                                </td>
                            </tr>
                        </div>
                    <?php endforeach; ?>

                    </tbody>
                </table>


                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="folder-list card">
            <div class="table-header">
                <h5 class="header-title">Levels & Locations</h5>
                <button class="table-btn add-folder-btn" data-toggle="modal" data-target="#add_folder_modal"><span>Add
                        Level or Location</span></button>
            </div>

            <div class="table-container">
                <table class="folder-table table-decoration" id="dataTable1">


                    <thead>

                    <tr>
                            <th>Levels / Locations</th>
                        <th>Action</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php foreach ($item_folder_paginate as $query) : ?>
                        <tr>
                            <td>
                                <?= h($query->folder_name) ?></td>
                            <td>
                                <div class="utility-btn-3">
                                    <?= $this->Html->link(
                                        '
													<button class="btn btn-primary tooltip">
                                                        <span >Items</span>
													</button>
												',
                                        ['controller' => 'Items', 'action' => 'index', $query->id, $currentprop_id, $query->folder_name, $property->property_name],
                                        ['escape' => false]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '

												<button class="btn btn-primary tooltip ">
                                                    <span>Edit</span>
												</button>
																	',
                                        ['controller' => 'ItemFolders', 'action' => 'edit', $query->id, $currentprop_id, $property->property_name],
                                        ['class' => 'folder-edit-btn', 'escape' => false]
                                    ) ?>
                                    <a data-toggle="modal" data-target="#something<?= $query->id ?>"
                                       class="folder-delete-btn">
                                        <button type="button" class="btn btn-danger tooltip">
                                            <span class="tooltip-text">Delete</span>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Confirmation Modal -->
                        <div id="something<?= $query->id ?>" class="modal">
                            <div class="modal-dialog modal-confirm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Are you sure?</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                id="cross">
                                            <span aria-hidden="true">X</span>
                                        </button>

                                    </div>
                                    <div class="delete-modal-body">
                                        <p>Do you really want to delete the folder? This process
                                            will delete all items contain in the folder and cannot be undone.</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel
                                        </button>
                                        <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'ItemFolders', 'action' => 'delete', $query->property_id, $query->id, $property->property_name], ['class' => 'btn btn-danger', 'style' => 'color:white;']) ?>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Modal End -->
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>

        <div class=" container-fluid ">
            <!--  Add Folder modal -->
            <div class="modal " id="add_folder_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- Popup header Start -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Level / Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Popup header End -->

                        <!-- Popup Body -->
                        <?= $this->Form->create($itemFolder) ?>
                        <div class="modal-body">

                            <div class="textfield">
                                <label for="recipient-name" class="textfield-label">Level / Location Name</label>
                                <input name="folder_name" id="folder_name" type="text" pattern="[A-Za-z0-9 -]{1,50}"
                                       title="Please only enter alphabetical characters, 1-50 characters"
                                       class="textfield-input">

                            </div>
                        </div>
                        <!-- Popup Body end -->

                        <!-- Popup Footer START -->
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary folder-submit"
                                    onclick="stopReload()">Submit
                            </button>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                        <!-- Popup Footer  END-->

                        <?= $this->Form->end() ?>

                    </div>
                </div>
            </div>
            <!-- end of the add folder pop up -->
            <!-- end of some testing -->

            <br>
            <br>
        </div>
    </div> <!-- End  Section C -->



    <div id="folder_delete_confirmation" class="modal">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Delete Folder</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cross">
                        <span aria-hidden="true">X</span>
                    </button>

                </div>
                <div class="delete-modal-body" style="padding: 5%">
                    <center>
                        <p>Do you really want to delete this folder?</p>
                        <p>This process will <b>permanently delete all files in this folder as well</b>.</p>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <?= $this->Form->postLink(__('Delete'),
                        ['controller' => 'PropertyStorageFolders', 'action' => 'delete', $storageFolder->id, $property->id],
                        ['class' => 'btn btn-danger', 'style' => 'color:white;']) ?>
                </div>
            </div>
        </div>
    </div>


</div>


<script>
    function clickRedirect(url)
    {
        window.location.href = url;
    }

    function changeFileStorageColour(number)
    {
        var fsSpan = document.getElementById("totalFileStorageSize");
        if (number > 0.5){
            fsSpan.setAttribute("style", "color: red");
        }
        else
        {
            fsSpan.setAttribute("style", "color: green");
        }
    }

    changeFileStorageColour(<?= $totalFileStorageSize ?>);

</script>
