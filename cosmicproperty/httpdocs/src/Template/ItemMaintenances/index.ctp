<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemMaintenances[]|\Cake\Collection\CollectionInterface $itemMaintenances
 */8126
?>
<style>
    .footer{
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: cornflowerblue;
        color: #fff3cd;
        text-align: center;
        height: 50px;
    }

    a {
        color: #7267EF;
    }
</style>

<p id="access-level" style="display:none;"><?= $access_level ?></p>


<div class="item-table-card">
    <div class="table-container">
        <?php echo  $this->Html->link(
            '<button class="btn btn-secondary" style="margin-bottom:10px"><span>  Back</span></button>',
            ['controller' => 'Properties', 'action' => 'dashboard', $property_id],
            ['escape' => false]
        ); ?>
        <div class="table-header">
            <h2>Item Maintenance List</h2>
        </div>

        <div>
            <div>
                <p id="itemList" style="display: none"><?php foreach ($item_maintenance_paginate as $query): ?>Item Name: <?= h($query->item_name) ?>; Item Status: <?= h($query->item_status) ?>;Item Location: <?= h($query->item_location) ?>; Cost Estimate: <?= h($query->cost_estimate) ?>;
                    <?php endforeach; ?></p>
            </div>

        <script>
            function copyList(){
                let copyText = document.getElementById("itemList");
                navigator.clipboard.writeText(copyText.innerHTML);

                alert("Item List has been copied to the clipboard");
            }
        </script>
            <button style="float: right; margin-left: 15px; margin-bottom: 15px" type="button" class="btn btn-primary" onclick="copyList()">Copy List Text</button>
            <button style="float: right; margin-bottom: 15px" type="button" class="btn btn-primary add-item-btn" data-toggle="modal" data-target="#add_item-maintenance_modal">Add Item</button>

        </div>

        <table class="item-table table-decoration">
            <thead>
                <tr>
                    <th scope="col"><?=$this->Paginator->sort('item_priority') ?></th>
                    <th scope="col"><?=$this->Paginator->sort('item_name') ?></th>
                    <th scope="col"><?=$this->Paginator->sort('item_status') ?></th>
                    <th scope="col"><?=$this->Paginator->sort('item_location') ?></th>
                    <th scope="col"><?=$this->Paginator->sort('cost_estimate') ?></th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- maintenance item list -->
                <?php foreach ($item_maintenance_paginate as $query) : ?>

                <tr>
                    <td data-label="Item Priority"><?= h($query->item_priority) ?></td>
                    <td data-label="Item Name"><?= h($query->item_name) ?></td>
                    <td data-label="Item Status"><?= h($query->item_status) ?></td>
                    <td data-label="Item Location"><?= h($query->item_location) ?></td>
                    <td data-label="Cost Estimate"><?= h($query->cost_estimate) ?></td>

                    <td data-label="Actions">
                        <div class="utility-btn-3">
                            <?= $this->Html->link(
                                    '
												<button class="btn btn-primary tooltip">
                                                    <span class="tooltip-text">View</span>
													<i class="fas fa-eye"></i>
												</button>',
                                    ['controller' => 'ItemMaintenances', 'action' => 'view', $query->id],
                                    ['escape' => false]
                                ) ?>
                            <?= $this->Html->link(
                                    '<button class="btn btn-primary tooltip">
                                        <span class="tooltip-text">Edit</span>
                                        <i class="fas fa-edit"></i>
                                    </button>',
                                    ['controller' => 'ItemMaintenances', 'action' => 'edit', $query->id],
                                    ['escape' => false, 'class' => 'item-edit-btn']
                                ) ?>

                            <a data-toggle="modal" data-target="#something<?= $query->id ?>" class="item-delete-btn">
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
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cross">
                                    <span aria-hidden="true">X</span>
                                </button>

                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $query->id], ['class' => 'btn btn-danger', 'style' => 'color:white;']) ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal End -->
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
    <?php
        $totalCost=0;
        foreach ($item_maintenance_paginate as $query):
        $totalCost = $totalCost + $query->cost_estimate;
        endforeach;
    ?>
    <div class="footer">
        <p style="font-size: 35px">Total Cost Estimate: $<?php echo $totalCost;  ?></p>
    </div>
</div>



<!-- Add item maintenance popup model -->

<div class="modal " id="add_item-maintenance_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Popup header Start -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a new Item record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cross">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <!-- Popup header End -->

            <!-- Popup Body -->
            <?= $this->Form->create($itemMaintenance) ?>
            <div class="modal-body">

                <div class="textfield">
                    <label class="textfield-label" for="item_name">Item Name</label>
                    <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9 -]{1,1000}"
                        title="Please only enter alphabetical characters, 1-1000 characters" id="item_name"
                        name="item_name" required="">

                </div>
                <div class="textfield">
                    <label class="textfield-label" for="item_status">Item Status</label>
                    <select class="textfield-input form-control" id="item_status" name="item_status" required="">
                        <option value=""></option>
                        <option value="General Comment">General Comment</option>
                        <option value="Compliance Check">Compliance Check</option>
                        <option value="Defect">Defect</option>
                        <option value="Maintainence Item">Maintenance Item</option>
                    </select>

                </div>

                <div class="textfield">
                    <label class="textfield-label" for="item_location">Item Location</label>
                    <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9 -]{1,1000}"
                        title="Please only enter alphabetical characters, 1-1000 characters" id="item_location"
                        name="item_location" required="">

                </div>
                <div class="textfield">
                    <label class="textfield-label" for="item_finding">Item Finding</label>
                    <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9 -]{1,1000}"
                        title="Please only enter alphabetical characters, 1-1000 characters" id="item_finding"
                        name="item_finding" required="">

                </div>
                <div class="textfield">
                    <label class="textfield-label" for="item_recommendation">Item Recommendation</label>
                    <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9 -]{1,1000}"
                        title="Please only enter alphabetical characters, 1-1000 characters" id="item_recommendation"
                        name="item_recommendation" required="">

                </div>
                <div class="textfield">
                    <label class="textfield-label" for="cost_estimate">Cost Estimate</label>
                    <input class="textfield-input form-control" type="number" max="999999999999" min="0" step="0.01"
                        id="cost_estimate" name="cost_estimate" required="" onchange="costEstimate()">
                    <span id="cost-estimate-error"></span>

                </div>
                <div class="textfield">
                    <label class="textfield-label" for="potential_hazard">Potential Hazard</label>
                    <select class="textfield-input form-control" id="potential_hazard" name="potential_hazard"
                        required="">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>

                </div>
                <div class="textfield">
                    <label class="textfield-label" for="item_priority">Item Priority</label>
                    <input class="textfield-input form-control" type="number" max="999999999999" min="1" step="1"
                           id="item_priority" name="item_priority" required="" ">

                </div>


            </div>
            <!-- Popup Body end -->

            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Submit </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>

            <?= $this->Form->end() ?>

        </div>
    </div>
</div>


