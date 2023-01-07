<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyStorageFolder[]|\Cake\Collection\CollectionInterface $propertyStorageFolders
 */

use Cake\ORM\TableRegistry;

$usersQuery = TableRegistry::getTableLocator()->get('Users');
$psfuQuery = TableRegistry::getTableLocator()->get('PropertyStorageFoldersUsers');

?>

<style>
    a {
        color: #7267EF;
    }
</style>

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
            <h2><?= h($storageFolder->folder_name) ?></h2>

            <?php
            if ($folderAccessCapabilities == 'all') {
                ?>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            style="float: right;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Folder Settings
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="
                    <?= $this->URL->build(['controller' => 'PropertyStorageFolders', 'action' => 'edit', $storageFolder->id, $property_id]) ?>
                    ">Rename</a>

                        <a data-toggle="modal" data-target="#folder_delete_confirmation"
                           class="dropdown-item" style="cursor:pointer;">
                            Delete
                        </a>
                    </div>
                </div>

            <?php }
            ?>

        </div>

        <div class="alert alert-info" role="alert" data-toggle="collapse" href="#collapseExample"
             aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
            <center>
                You have <b><?= $folderAccessCapabilities ?></b> access to this folder.
                <div class="collapse" id="collapseExample">
                    <hr class="dashed">
                    <p><b>Note</b>: Users with access level 0s and 1s have managerial access to all folders within the property by default.</p>
                </div>
            </center>
        </div>


        <table class="item-table table-decoration" >
            <thead>
            <tr>
                <th scope="col"><?=$this->Paginator->sort('file_name') ?></th>
                <th scope="col"><?=$this->Paginator->sort('uploaded_by') ?></th>
                <th scope="col"><?=$this->Paginator->sort('uploaded_date') ?></th>
                <th scope="col"><?=$this->Paginator->sort('file_details') ?></th>
                <th scope="col" class="actions">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($storageFiles as $propertyStorageFile): ?>
                <tr>
                    <td><?= h($propertyStorageFile->file_name) ?></td>
                    <td>
                        <?php
                        $user = $usersQuery->find()->select([])
                            ->where(['id' => $propertyStorageFile->uploaded_by])
                            ->first();

                        echo $user->first_name . ' ' . $user->last_name;
                        ?>
                    </td>
                    <td><?= h($propertyStorageFile->uploaded_date) ?></td>
                    <td style="word-wrap:break-word;"><?= h($propertyStorageFile->file_details) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(
                            '
                                        <button type="button" class="btn btn-outline-primary tooltip ">
                                            <span class="tooltip-text">Download</span>
                                            <i class="fas fa-download"></i>
                                        </button>
                                    ',
                            ['controller' => 'PropertyStorageFolders', 'action' => 'fileDownload', $propertyStorageFile->id, $property_id],
                            ['escape' => false, 'class' => 'item-edit-btn']
                        ) ?>

                        <?php
                        if ($folderAccessCapabilities == 'all' || $folderAccessCapabilities == 'contributor') {
                            ?>

                            <?= $this->Html->link(
                                '
                                                <button class="btn btn-primary tooltip">
                                                    <span class="tooltip-text">Edit</span>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            ',
                                ['controller' => 'PropertyStorageFiles', 'action' => 'edit', $propertyStorageFile->id, $storageFolder->id, $property_id],
                                ['escape' => false, 'class' => 'item-edit-btn']
                            ) ?>


                        <?php } if ($folderAccessCapabilities == 'all') { ?>
                            <a data-toggle="modal"
                               data-target="#file_delete_confirmation<?= $propertyStorageFile->id ?>"
                               class="item-delete-btn">
                                <button type="button" class="btn btn-danger tooltip ">
                                    <span class="tooltip-text">Delete</span>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </a>
                        <?php } ?>
                    </td>
                </tr>

                <div id="file_delete_confirmation<?= $propertyStorageFile->id ?>" class="modal">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Delete File</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cross">
                                    <span aria-hidden="true">X</span>
                                </button>

                            </div>
                            <div class="delete-modal-body" style="padding: 5%">
                                <center>
                                    <p>Do you really want to delete this file?</p>
                                    <p>This process will <b>permanently delete</b> the file.</p>
                                </center>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'PropertyStorageFiles', 'action' => 'delete', $propertyStorageFile->id, $storageFolder->id, $property_id], ['class' => 'btn btn-danger', 'style' => 'color:white;']) ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        if ($folderAccessCapabilities == 'all' || $folderAccessCapabilities == 'contributor') {
            ?>
            <tr>
                <td colspan="5" style="background-color: #19B3D3;">
                    <button type="button btn-block" class="btn add-item-btn form-control" data-toggle="modal"
                            style="background-color: #19B3D3; color: #f0f0f0; font-family: 'Roboto', sans-serif;"
                            data-target="#addFileModal" data-whatever="@mdo">
                        ADD FILE
                    </button>
                </td>
            </tr>
        <?php } ?>

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>


<div class="modal" id="addFileModal" role="dialog" aria-labelledby="confirmBack"
     aria-hidden="true">
    <div class="modal-dialog modal-confirm"
         style="box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);">

        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Upload a new file</h3>
                <button type="button" class="close" data-dismiss="modal" onclick="hideConfirmBackModal()"
                        aria-label="Close"
                        id="cross">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <?= $this->Form->create($propertyStorageFile, ['type' => 'file']) ?>
            <div class="modal-body">
                <div class="file-name-field textfield">
                    <label class="textfield-label" for="file_name">File Name</label>
                    <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                           title="Please only enter alphabetical characters, 1-50 characters" id="file_name"
                           name="file_name" required="" maxlength="30">
                </div>

                <br>

                <div class="textfield">
                    <label class="textfield-label" for="file_details">File Details</label>
                    <textarea class="form-control" type="text" pattern="[A-Za-z0-9. -]{1,250}"
                              title="Please only enter alphabetical characters, 1-250 characters" id="file_details"
                              name="file_details" required="" maxlength="250"></textarea>
                </div>

                <br>

                <div class="textfield">
                    <label class="textfield-label" for="file_path">Select file to upload: </label>
                    <?php
                    echo $this->Form->file('file', ['type' => 'file']);
                    ?>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= $this->Form->end() ?>
        </div>

    </div>
</div>


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
                <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $storageFolder->id, $property_id], ['class' => 'btn btn-danger', 'style' => 'color:white;']) ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>

