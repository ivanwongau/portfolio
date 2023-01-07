<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFoldersUser[]|\Cake\Collection\CollectionInterface $propertyStorageFoldersUser
 */

use Cake\ORM\TableRegistry;

$foldersQuery = TableRegistry::getTableLocator()->get('PropertyStorageFolders');
$currentFolder = $foldersQuery->find()->select([])
    ->where(['id' => $folder_id])
    ->first();

$usersQuery = TableRegistry::getTableLocator()->get('Users');
$propertyStorageFoldersUsersQuery = TableRegistry::getTableLocator()->get('PropertyStorageFoldersUsers');
?>

<?php if ($access_level === 'none') { ?>
<?php } else { ?>

    <div class="item-table-card">
        <div class="table-container">

            <?php echo $this->Html->link(
                '<button class="btn btn-secondary" style="margin-bottom:10px;"><span>   Back</span></button>',
                ['controller' => 'Properties', 'action' => 'dashboard', $property_id],
                ['escape' => false]
            ); ?>

            <div class="table-header">
                <h2><?= $currentFolder->folder_name ?> User Access List</h2>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            style="float: right;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Folder
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php

                        foreach ($storageFolders as $folder): ?>
                            <a class="dropdown-item" href="
                    <?= $this->URL->build(['controller' => 'PropertyStorageFoldersUsers', 'action' => 'index', $folder->id, $property_id]) ?>
                    ">
                                <?php
                                echo $folder->folder_name
                                ?>
                            </a>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <div class="section-uc">

                <div class="alert alert-info" role="alert" data-toggle="collapse" href="#collapseExample"
                     aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
                    <center>
                        <h5>Set the access rights for each property user on a folder level</h5>
                        (Click on this box to see legend for access levels)
                    </center>
                    <div class="collapse" id="collapseExample">
                        <center>
                            <hr class="dashed">
                            <p><b>Note</b>: Users with access level 0s and 1s have managerial access to all folders
                                within
                                the property by default.</p>
                            <hr class="dashed">
                            <p style="background-color: white;"><b>No Access</b>: The user has no access whatsoever to
                                this
                                folder.</p>
                            <p style="background-color: #ccffff;"><b>Viewer Access</b>: The user can view and download
                                the
                                contents of this folder.</p>
                            <p style="background-color: #ccff99"><b>Contributor Access</b>: The user can view, download,
                                and edit contents of this folder.</p>
                            <p style="background-color: #ff9966"><b>Managerial Access</b>: The user has contributor
                                access
                                and can control the user access list.</p>
                        </center>
                    </div>
                </div>


                <div>
                    <center>
                        Set access rights to
                        <select name="folder_access_level" id="ddl_default_folder_access">
                            <option value="0">no access</option>
                            <option value="1">Viewer Access</option>
                            <option value="2">Contributor Access</option>
                            <option value="3">Managerial Access</option>
                        </select>
                        for
                        <select name="targeted_users" id="ddl_targeted_users">
                            <option value="none">no</option>
                            <option value="all">all</option>
                            <option value="AL2">Access Level 2</option>
                            <option value="AL3">Access Level 3</option>
                            <option value="AL4">Access Level 4</option>
                            <option value="AL5">Access Level 5</option>
                        </select>
                        property users

                        &nbsp &nbsp &nbsp

                        <button
                            class="btn btn-sm"
                            style="background-color: lightgrey; color: black;"
                            onclick="clickRedirect('<?= $this->URL->build(['action' => 'setdefaultaccess', $folder_id, $property_id])?>')"
                        >
                            CONFIRM
                        </button>
                    </center>
                </div>

                <table class="item-table table-decoration" id="users_table">
                    <thead>
                    <tr>
                        <th onclick="sortTable(0)" style="cursor: pointer">User</th>
                        <th onclick="sortTable(1)" style="cursor: pointer">Property Access Level</th>
                        <th>Folder Access Level</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if (!$hasUsers) {
                    ?>
                    <tr>
                        <td colspan="3">
                            <center>
                                There are no users that are not an admin or below access level 0 or 1 that are assigned to this property.

                                <br>

                                <?php echo $this->Html->link(
                                    '<h6>Assign more users to the property.</h6>',
                                    ['controller' => 'Properties', 'action' => 'action', $property_id],
                                    ['escape' => false]
                                ); ?>
                            </center>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>

                    <?= $this->Form->create($propertyStorageFoldersUser, ['class' => 'row']) ?>
                    <?php
                        $count = 0;

                        foreach ($propertyUsers as $propertyUser) {

                        $user = $usersQuery->find()->select([])
                            ->where(['id' => $propertyUser->user_id])
                            ->first();

                        $psfu = $propertyStorageFoldersUsersQuery->find()->select([])->where(['user_id' => $propertyUser->user_id, 'property_storage_folder_id' => $folder_id])->first();
                        $propertyUserAccessLevel = $psfu != null ? $psfu->folder_access_level : 0;

                        echo $this->Form->hidden($count . '.id', ['value' => $psfu != null ? $psfu->id : null]);
                        echo $this->Form->hidden($count . '.user_id', ['value' => $propertyUser->user_id]);
                        echo $this->Form->hidden($count . '.property_storage_folder_id', ['value' => $folder_id]);

                    ?>

                    <tr>
                        <td><?= $user->first_name . ' ' . $user->last_name ?></td>
                        <td><?= $propertyUser->access_level; ?></td>
                        <td>
                            <?php echo $this->Form->select(
                                $count . '.folder_access_level',
                                [0 => 'No Access', 1 => 'Viewer Access', 2 => 'Contributor Access', 3 => 'Managerial Access'],
                                ['default' => $propertyUserAccessLevel]
                            );
                            ?>
                        </td>
                    </tr>

                    <?php $count++;
                        } ?>
                    </tbody>
                </table>
                <?php
                if ($hasUsers) {
                    ?>
                    <tr>
                        <td colspan="5" style="background-color: #19B3D3;">
                            <button type="submit" class="btn add-item-btn form-control btn-block"
                                    style="background-color: #19B3D3; color: #f0f0f0; font-family: 'Roboto', sans-serif;">
                                <b>
                                    SAVE
                                </b>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("users_table");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }

    function clickRedirect(url)
    {
        url+= "/" + document.getElementById("ddl_default_folder_access").value + "/" + document.getElementById("ddl_targeted_users").value;
        window.location.href = url;
    }
</script>

