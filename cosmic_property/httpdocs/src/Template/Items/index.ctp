<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item[]|\Cake\Collection\CollectionInterface $item
 */
?>

<style>
    .textfield #height,
    .textfield #width {
        margin-top: 10px;
    }
</style>

<body onbeforeunload="return offlineCheck();"></body>

<p id="access-level" style="display:none;"><?= $access_level ?></p>


<div class="item-table-card">
    <div class="table-container">

    <a data-toggle="modal" id="backButton">
        <button type="button" class="btn btn-secondary" style="margin-bottom:10px;">
            Back
        </button>
    </a>

    <div class="table-header">
        <div class="name-area">
            <h2>Item table</h2>
            <h3><?= $folder_name ?></h3>
        </div>
        <div class="alert alert-warning" role="alert" style="float: right;">
            Rows highlighted in yellow signal items that have not yet been submitted to the server.
        </div>

    </div>

    <table class="item-table table-decoration">
        <thead>
        <tr>
            <th>Item Name</th>
            <th>Expected Year Due</th>
            <th>Number of Years Due</th>
            <th>Item Total</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($item_paginate as $query) : ?>
            <tr>
                <td data-label="Item Name"><?= h($query->item_name) ?></td>
                <td data-label="Expected Year Due"><?= h($query->expected_year_due) ?></td>
                <td data-label="Number of Years Due"><?= h($query->year_due) ?></td>
                <td data-label="Item Total">
                    <?php $display_item_total = number_format(h($query->item_total), 2);
                    echo "$$display_item_total"; ?>
                </td>
                <td data-label="Actions">
                    <div class="utility-btn-3">
                        <?= $this->Html->link(
                            '
												<button class="btn btn-primary tooltip">
                                                    <span class="tooltip-text">View</span>
													<i class="fas fa-eye"></i>
												</button>
											',


                            ['controller' => 'Items', 'action' => 'view', $query->id, $folder_id, $property_id, $folder_name, $currentprop_name],
                            ['escape' => false]
                        ) ?>
                        <?= $this->Html->link(
                            '
                                                <button class="btn btn-primary tooltip">
                                                    <span class="tooltip-text">Edit</span>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            ',
                            ['action' => 'edit', $query->id, $folder_id, $property_id, $folder_name, $query->item_name, $currentprop_name],
                            ['escape' => false, 'class' => 'item-edit-btn']
                        ) ?>


                        <a data-toggle="modal" data-target="#item_delete_confirmation<?= $query->id ?>"
                           class="item-delete-btn">
                            <button type="button" class="btn btn-danger tooltip ">
                                <span class="tooltip-text">Delete</span>
                                <i class="fas fa-trash"></i>
                            </button>
                        </a>
                    </div>
                </td>
            </tr>

            <!-- Delete Confirmation Modal -->
            <div id="item_delete_confirmation<?= $query->id ?>" class="modal">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Delete Item</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cross">
                                <span aria-hidden="true">X</span>
                            </button>

                        </div>
                        <div class="delete-modal-body" style="padding: 5%">
                            <center>
                                <p>Do you really want to delete this item?</p>
                                <p>This process will delete the item information and <b>cannot be undone</b>.</p>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $query->id, $folder_id, $property_id, $folder_name, $currentprop_name], ['class' => 'btn btn-danger', 'style' => 'color:white;']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        </tbody>
    </table>
    <!-- Add Item Button -->
    <tr>
        <td colspan="5" style="background-color: #19B3D3;">
            <?php if ($propertyspec->first()->finalized == "false") : ?>
                <button type="button btn-block" class="btn add-item-btn form-control" data-toggle="modal"
                        style="background-color: #19B3D3; color: #f0f0f0; font-family: 'Roboto', sans-serif;"
                        data-target="#addItemModal" data-whatever="@mdo" onclick="changeToCreateHeader()">
                    ADD ITEM
                </button>
            <?php else : ?>
                <center>
                    <h5 style="color: black;">This property has been finalised; no more items can be added.</h5>
                </center>
            <?php endif; ?>
        </td>
    </tr>

</div>
</div>


<!-- Popup for Add Item -->
<div class="modal" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <!-- Popup header Start -->
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Create a new Item</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cross">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <!-- Popup header End -->

            <!-- Popup Body -->
            <form id="addItemForm">
                <!-- </? = $this->Form->create($item) ?> -->
                <div class="modal-body">
                    <div class="item-name-field textfield">
                        <label class="textfield-label" for="item_name">Item Name</label>
                        <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                               title="Please only enter alphabetical characters, 1-50 characters" id="item_name"
                               name="item_name" required="" maxlength="30">

                    </div>

                    <div class="UOM-field textfield">
                        <label class="textfield-label" for="item_unit_of_mes">Unit Of Measurement</label>
                        <select class="textfield-input form-control" id="item_unit_of_mes" name="item_unit_of_mes"
                                required="" onchange="measurementTool(this.value);">
                            <option value=""></option>
                            <option value="m2">M2</option>
                            <option value="L/M or No">L/M or No</option>
                            <option value="Ea">Ea</option>
                        </select>

                    </div>

                    <div class="measurement-field textfield">
                        <label class="textfield-label" for="item_quantity">Quantity</label>
                        <input class="textfield-input form-control" type="number" max="100000" step="0.01" min="1"
                               id="item_quantity" name="item_quantity" required="" onchange="calculateItemTotalCost()"
                               onKeyPress="if(this.value.length==6) return false;" >

                    </div>


                    <!-- Measurement Tool / area calculator -->
                    <div id="area-calculator" style="display:none" class="measurement-tool">
                        <hr class="solid" id="divider_add_item" style="border-top:1px solid;">

                        <div class="measurement-tool-header">
                            <h4>Measurement Tool Area</h4>
                            <button type="button" class="btn btn-primary" onclick="addMeasureField()">
                                Add
                            </button>

                        </div>

                        <div id="hw-new-fields">
                            <div class="data-field" id="new-field-section"></div>
                        </div>

                        <div class="data-field">
                            <div class="height-field textfield">
                                <select class="textfield-input form-control" id="">
                                    <option value="">Height</option>
                                    <option value="">Length</option>
                                </select>
                                <input class="textfield-input form-control" type="number" max="100000" step="0.01"
                                       min="0" onKeyPress="if(this.value.length==6) return false;"
                                       id="height" name="" value="">
                            </div>
                            <div class="width-field textfield">
                                <select class="textfield-input form-control" id="">
                                    <option value="">Width</option>
                                    <option value="">Depth</option>
                                </select>
                                <input class="textfield-input form-control" type="number" max="100000" step="0.01"
                                       min="0" onKeyPress="if(this.value.length==6) return false;"
                                       id="width" name="" value="">
                            </div>
                        </div>

                        <div class="measurement-tool-result">
                            <div class="textfield">
                                <label class="textfield-label" for="">Result</label>
                                <input class="textfield-input form-control" type="number" id="result" name="" readonly>
                            </div>

                            <button type="button" class="btn btn-primary" onclick="calculateItemArea()">Calculate
                            </button>
                        </div>
                        <hr class="solid" id="divider_add_item" style="border-top:1px solid;">

                    </div>
                    <!-- end of measurement Tool / area calculator -->

                    <!-- Measurement Tool / L/M calculator -->
                    <div id="lm-calculator" style="display:none" class="measurement-tool">
                        <hr class="solid" id="divider_add_item" style="border-top:1px solid;">

                        <div class="measurement-tool-header">
                            <h4>Measurement Tool Area</h4>
                            <button tyn
                            " class="btn btn-primary" onclick="addMeasureFieldLength()">
                            Add
                            </button>
                        </div>

                        <div id="lm-new-fields" style="background-color: white;">
                            <div id="new-field-sectionlm"></div>
                        </div>

                        <div class="data-field">

                            <div class="textfield">
                                <label class="textfield-label" for="">Length/No</label>

                                <input class="textfield-input form-control" type="number" max="100000" step="0.01"
                                       min="0" onKeyPress="if(this.value.length==6) return false;"
                                       id="length" name="" value="">
                            </div>

                        </div>


                        <div class="measurement-tool-result">
                            <div class="textfield">
                                <label class="textfield-label" for="">Result</label>
                                <input class="textfield-input form-control" type="number" id="resultlm" name=""
                                       readonly>
                            </div>

                            <button type="button" class="btn btn-primary" onclick="calculateItemLength()">Calculate
                            </button>
                        </div>

                        <hr class="solid" id="divider_add_item" style="border-top:1px solid;">

                    </div>
                    <!-- end of measurement Tool / L/M calculator -->

                    <div class=" rate-field textfield">
                        <label class="textfield-label" for="item_rate">Rate</label>
                        <input class="textfield-input form-control" type="number" max="999999999999" id="item_rate"
                               onKeyPress="if(this.value.length==12) return false;"
                               step="0.01" min="0" name="item_rate" required="" oninput="calculateItemTotalCost()">

                    </div>

                    <div class="total-cost-field textfield">
                        <label class="textfield-label" for="item_total">Item Total Cost</label>
                        <input class="textfield-input form-control" type="number" id="item_total" name="item_total"
                               step="0.01" required="" readonly>

                    </div>

                    <div class="item-condition-field textfield">
                        <label class="textfield-label" for="item_condition">Item Condition</label>
                        <select class="textfield-input form-control" id="item_condition" name="item_condition"
                                required="">
                            <option value=""></option>
                            <option value="Brand_New">Brand New</option>
                            <option value="Good">Good</option>
                            <option value="okay">okay</option>
                            <option value="Operational">Operational</option>
                            <option value="Needs repair">Needs repair</option>
                            <option value="Broken">Broken</option>
                        </select>

                    </div>
                    <div class="allowance-field textfield">
                        <label class="textfield-label" for="item_allowance">Action</label>
                        <select class="textfield-input form-control" id="item_allowance" name="item_allowance"
                                required="">
                            <option value=""></option>
                            <option value="Replacement">Replacement</option>
                            <option value="Upgrade">Upgrade</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>

                    </div>
                    <div class="expected-field textfield">
                        <label class="textfield-label" for="expected_life">Expected Life</label>
                        <input class="textfield-input form-control" type="number" max="100" min="0" id="expected_life"
                               onKeyPress="if(this.value.length==3) return false;"
                               placeholder="Please input the number in years"
                               name="expected_life" required="" onchange="expectedLifeValidation()">
                        <span id="expected-life-error"></span>

                    </div>
                    <div class="year-due-field textfield">
                        <label class="textfield-label" for="year_due">Action Due By</label>
                        <input class="textfield-input form-control" type="number" max="100" min="1" id="year_due"
                               onKeyPress="if(this.value.length==3) return false;"
                               placeholder="Please input the number in years"
                               name="year_due" required="" oninput="calculateExpectedYeearDue()"
                               onchange="yearDueValidation()">
                        <span id="year-due-error"></span>

                    </div>

                    <div class="textfield">
                        <label class="textfield-label" for="oriDate">Maintenance Plan Inspection Date</label>

                        <input class="textfield-input form-control" type="text" id="oriDate" name="oriDate"
                               value='<?= $propertyspec->first()->property_date->i18nFormat('yyyy') ?>' disabled>
                    </div>
                    <div class="textfield">
                        <label class="textfield-label" for="expected_year_due">Expected Year Due</label>
                        <input class="textfield-input form-control" type="text" id="expected_year_due"
                               name="expected_year_due" value="" readonly>
                    </div>

                    <div class="textfield">
                        <label class="textfield-label" for="">Folder Name</label>
                        <input class="textfield-input form-control" type="Text" id="folder_id" name="" required=""
                               value="<?= h($folder_name) ?>" disabled>
                        <input id="folder_id_int" value="<?= $folder_id ?>" aria-hidden="true" hidden>
                    </div>
                </div>

            </form>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="item_submit" onclick="submitToCache()">
                    Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!--Delete Modal-->
<div id="ls_delete_modals">
</div>

<!-- Back Confirm Modal -->
<div class="modal" id="confirmBackModal" role="dialog" aria-labelledby="confirmBack"
     aria-hidden="true">
    <div class="modal-dialog modal-confirm"  style="box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Are you sure?</h3>
                <button type="button" class="close" data-dismiss="modal" onclick="hideConfirmBackModal()"
                        aria-label="Close"
                        id="cross">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <div class="leave-modal-body" style="padding: 5%; background-color: #f2f2f2">
                <center>
                    <p>You have <b>unsaved items</b> added to this level.</p>
                    <p>Leaving without submitting <b>may remove</b> these items on your next visit.</p>
                    <br>
                    <h5>Are you sure you want to leave without submitting?</h5>
                </center>
            </div>

            <div class="modal-footer" style="background-color: #bfbfbf">
                <button class="btn btn-secondary" data-dismiss="modal"
                        onclick="hideConfirmBackModal()" >
                    Stay
                </button>
                <?php echo  $this->Html->link(
                    '<button class="btn btn-danger"><span>Leave</span></button>',
                    ['controller' => 'Properties', 'action' => 'dashboard', $property_id],
                    ['escape' => false]
                ); ?>

            </div>

        </div>
    </div>
</div>

<!-- Submit Footer -->
<?php if ($propertyspec->first()->finalized == "false") : ?>
    <div class="footer" id="send-json">
        <a class="pointer" style="color: white; text-decoration: none;"><h2>SUBMIT</h2></a>
    </div>
<?php endif; ?>



<!-- JS & CSS -->

<script type="text/javascript">
    // Preventing leave while offline
    function offlineCheck() {
        if (!navigator.onLine)
        {
            alert('There is no stable connection.  Please try again once you can connect to the internet.');
        }
    }


    // Define class object, this is to be used to translate the items into a JS class to pass to JSON to pass to PHP.
    // Important to keep the same names as the PHP entity equivalents.
    class ItemObject {
        constructor(name, quantity, unitOfMeasurement, rateOfItem, totalAmount, allowance, condition, yearsDue, expectedLife, expectedYearDue,
                    folderId) {
            this.item_name = name;
            this.item_quantity = quantity;
            this.item_unit_of_mes = unitOfMeasurement;
            this.item_rate = rateOfItem;
            this.item_total = parseFloat(totalAmount.replace(/,/g, ''));
            this.item_allowance = allowance;
            this.item_condition = condition;
            this.year_due = yearsDue;
            this.expected_life = expectedLife;
            this.expected_year_due = expectedYearDue;
            this.folder_id = folderId;
        };
    }

    var itemList = [];

    // BACK BUTTON/MODAL COSMETICS
    // Checks if back button should be triggered
    $('#backButton').click(function () {
        itemList = JSON.parse(localStorage.getItem("itemList"));
        if (itemList == null || itemList.length == 0) {
            window.location.href = "<?= $this->URL->build(['controller' => 'Properties', 'action' => 'dashboard', $property_id]) ?>";
        } else {
            $('#confirmBackModal').show();
        }
    })

    // Removes modal from screen.
    function hideConfirmBackModal(){
        $('#confirmBackModal').hide();
    }

    // Refreshes modal.
    $('#addItemModal').on('hidden.bs.modal', function () {
        localStorage.removeItem("observedItemIndex");
        $(this).find('form').trigger('reset');
        let error_ref = document.querySelector("#year-due-error");
        error_ref.innerHTML = "";

        document.getElementById("lm-new-fields").innerHTML = "";
        document.getElementById("hw-new-fields").innerHTML = "";
    })

    // For the modal, changes the header to "Create New Item".  Called when clicking "Add Item".
    function changeToCreateHeader(){
        let modalHeader = document.querySelector("#exampleModalLabel");
        modalHeader.innerHTML = "Create New Item";
    }

    // GRABS DATA FROM LOCALSTORAGE
    // Loads cache data for the table
    function loadDataFromCache(id) {
        // Set international number format to format money.
        let internationalNumberFormat = new Intl.NumberFormat('en-US');

        // Get local storage item.
        let localstorageList = JSON.parse(localStorage.getItem("itemList"));
        let selectedItem = localstorageList[id]

        // Set the modal header to refer to editing the selected item.
        let modalHeader = document.querySelector("#exampleModalLabel");
        modalHeader.innerHTML = "Edit "+ selectedItem.item_name + " information";

        // Map it to the modal.
        document.getElementById('item_name').value = selectedItem.item_name;
        document.getElementById('item_quantity').value = selectedItem.item_quantity;
        document.getElementById('item_unit_of_mes').value = selectedItem.item_unit_of_mes;
        document.getElementById('item_rate').value = selectedItem.item_rate;
        document.getElementById('item_total').value = selectedItem.item_total;
        document.getElementById('item_allowance').value = selectedItem.item_allowance;
        document.getElementById('item_condition').value = selectedItem.item_condition;
        document.getElementById('year_due').value = selectedItem.year_due;
        document.getElementById('expected_life').value = selectedItem.expected_life;
        document.getElementById('expected_year_due').value = selectedItem.expected_year_due;
        document.getElementById('folder_id_int').value = selectedItem.folder_id;

        // This sets the item to reload.
        localStorage.setItem("observedItemIndex", id);
    }

    // ADDING DATA TO CACHE
    // Used for add and edit modals, when clicking on the submit button inside them- this routes to whichever
    // functionality the user has intended.
    function submitToCache() {
        let observedItemIndex = localStorage.getItem("observedItemIndex");
        if (observedItemIndex != null) {
            observedItemIndex = parseInt(observedItemIndex);
            updateCache(observedItemIndex);
        } else {
            addToCache();
        }
    }

    // Adding a new item to the cache.
    function addToCache() {
        // Handles money formatting.
        let internationalNumberFormat = new Intl.NumberFormat('en-US');

        // Gets data from modal.
        let itemName = document.getElementById('item_name').value;
        let itemQuantity = document.getElementById('item_quantity').value;
        let itemUoM = document.getElementById('item_unit_of_mes').value;
        let itemRate = document.getElementById('item_rate').value;
        let itemTotal = internationalNumberFormat.format(document.getElementById('item_total').value);
        let itemAllowance = document.getElementById('item_allowance').value;
        let itemCondition = document.getElementById('item_condition').value;
        let itemYearsDue = document.getElementById('year_due').value;
        let itemExpLifetime = document.getElementById('expected_life').value;
        let itemExpYearDue = document.getElementById('expected_year_due').value;
        let itemFolderId = document.getElementById('folder_id_int').value;

        if (itemName != null && itemName != "" &&
            itemQuantity != null && itemQuantity != "" &&
            itemUoM != null && itemUoM != "" &&
            itemRate != null && itemRate != "" &&
            itemTotal != null && itemTotal != "" &&
            itemAllowance != null && itemAllowance != "" &&
            itemCondition != null && itemCondition != "" &&
            itemYearsDue != null && itemYearsDue != "" &&
            itemExpLifetime != null && itemExpLifetime != "" &&
            itemExpYearDue != null && itemExpYearDue != "" &&
            itemFolderId != null && itemFolderId != ""
        )
        {
            // Makes new object from the data above.
            let addedItem = new ItemObject(itemName, itemQuantity, itemUoM, itemRate, itemTotal, itemAllowance, itemCondition, itemYearsDue,
                itemExpLifetime, itemExpYearDue, itemFolderId);

            // Pushes to the localStorage itemList.
            itemList = JSON.parse(localStorage.getItem("itemList"));
            if (itemList == null) {
                itemList = [];
            }
            itemList.push(addedItem);
            localStorage.setItem("itemList", JSON.stringify(itemList));

            // Refreshes cached table.
            refreshTable();

            $("#addItemModal").removeClass("in");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $(".modal-backdrop").remove();
            $("#addItemModal").hide();
        }
        else
        {
            alert("The form is incomplete. There is one or more empty field. Please ensure all fields are properly filled out.");
        }
    }

    // Used for editing an existing localStorage item.
    function updateCache(id) {
        // Set international number format to format money.
        let internationalNumberFormat = new Intl.NumberFormat('en-US');

        // Get local storage item
        let localstorageList = JSON.parse(localStorage.getItem("itemList"));

        // Get values from modal
        var itemName = document.getElementById('item_name').value;
        var itemQuantity = document.getElementById('item_quantity').value;
        var itemUoM = document.getElementById('item_unit_of_mes').value;
        var itemRate = document.getElementById('item_rate').value;
        var itemTotal = internationalNumberFormat.format(document.getElementById('item_total').value);
        var itemAllowance = document.getElementById('item_allowance').value;
        var itemCondition = document.getElementById('item_condition').value;
        var itemYearsDue = document.getElementById('year_due').value;
        var itemExpLifetime = document.getElementById('expected_life').value;
        var itemExpYearDue = document.getElementById('expected_year_due').value;
        var itemFolderId = document.getElementById('folder_id_int').value;

        if (itemName != null && itemName != "" &&
            itemQuantity != null && itemQuantity != "" &&
            itemUoM != null && itemUoM != "" &&
            itemRate != null && itemRate != "" &&
            itemTotal != null && itemTotal != "" &&
            itemAllowance != null && itemAllowance != "" &&
            itemCondition != null && itemCondition != "" &&
            itemYearsDue != null && itemYearsDue != "" &&
            itemExpLifetime != null && itemExpLifetime != "" &&
            itemExpYearDue != null && itemExpYearDue != "" &&
            itemFolderId != null && itemFolderId != ""
        )
        {
            // Create new item from those values
            var updatedItem = new ItemObject(itemName, itemQuantity, itemUoM, itemRate, itemTotal, itemAllowance, itemCondition, itemYearsDue,
                itemExpLifetime, itemExpYearDue, itemFolderId);

            // Change info in that specific index.
            localstorageList[id] = updatedItem;
            localStorage.setItem("itemList", JSON.stringify(localstorageList));

            // Clear and reload table
            clearTable(true);
            generateTable();

            // Removing observedItemIndex as editing is done.
            localStorage.removeItem("observedItemIndex");

            $("#addItemModal").removeClass("in");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $(".modal-backdrop").remove();
            $("#addItemModal").hide();
        }
        else
        {
            alert("The form is incomplete. There is one or more empty field. Please ensure all fields are properly filled out.");
        }
    }


    // Sends data to back end.  Triggered when submitting.
    $('#send-json').on('click', function () {
        let data = JSON.parse(localStorage.getItem("itemList"));

        $.ajax({
            type: "POST",
            data: {"itemsData": JSON.stringify(data)},
            url: '<?= $this->Url->build(['controller' => 'Items', 'action' => 'saveItems']) ?>',
            headers: {
                'X-CSRF-Token': '<?= $this->request->getParam('_csrfToken') ?>'
            },
            success: function()
            {
                if (navigator.onLine)
                {
                    localStorage.removeItem("itemList");
                    localStorage.removeItem("observedItemIndex");
                    location.reload();
                } else {
                    alert('An error has occurred with your request.  Please try again at a later time.');
                }
            },
            error: function ()
            {
                itemList = JSON.parse(localStorage.getItem("itemList"));
                if (itemList == null || itemList.length == 0) {
                    alert('There is nothing to submit.');
                }
                else if (!navigator.onLine)
                {
                    alert('There is no stable connection.  Please try again once you can connect to the internet.');
                }
                else
                {
                    alert('An unexpected problem has occurred.  Please try again later.');
                }
            }
        });
    })

    // TABLE DISPLAY CONFIGURATIONS
    // The columns used in the display table.  Key and value pairing.
    let interestedColumns = {
        "Item Name": "item_name",
        "Expected Year Due": "expected_year_due",
        "Number of Years Due": "year_due",
        "Item Total": "item_total"
    };

    // Called for initial setup.
    function setupTable() {
        let localstorageList = JSON.parse(localStorage.getItem("itemList"));
        let table = document.querySelector("tbody");
        generateTable(table, localstorageList);
    }

    // Appends each localStorage item as a row.
    function generateTable() {
        let table = document.querySelector("table");
        itemList = JSON.parse(localStorage.getItem("itemList"));

        let internationalNumberFormat = new Intl.NumberFormat('en-US');

        // Loop through each item of itemList
        if (itemList != null && itemList != []) {
            let index = 0;
            for (let element of itemList) {
                let row = table.insertRow();
                row.setAttribute("style", "background-color: #E3DBB7");

                // Getting data from items that need to be displayed for table
                for (let key in interestedColumns) {
                    // Item Name, Expected Year Due, Item Total, Action
                    let cell = row.insertCell();
                    cell.setAttribute("data-label", key);
                    let text = document.createTextNode(element[interestedColumns[key]]);
                    if (key == "Item Total") {
                        text = document.createTextNode("$" + internationalNumberFormat.format(element[interestedColumns[key]]));
                    }
                    cell.appendChild(text);
                }

                let actionsCell = row.insertCell();
                let actionButtons =
                    `<div class="utility-btn-3">
                        <a data-toggle="modal" data-target="#addItemModal"
                            class="item-add-btn">
                                <button type="button" class="btn btn-primary tooltip" onclick="loadDataFromCache(` + index + `)">
                                    <span class="tooltip-text">Edit</span>
                                    <i class="fas fa-edit"></i>
                                </button>
                        </a>
                        <a data-toggle="modal" data-target="#ls_item_delete_confirmation` + index + `"
                            class="item-delete-btn">
                                 <button type="button" class="btn btn-danger tooltip ">
                                     <span class="tooltip-text">Delete</span>
                                     <i class="fas fa-trash"></i>
                                 </button>
                        </a>
                    </div>`;
                actionsCell.insertAdjacentHTML("afterbegin", actionButtons);

                addDeleteModalForLocalStorageItem(index);

                index++;
            }
        }
    }

    // DELETE MODAL & FUNCTIONALITY
    function addDeleteModalForAllLocalStorageItems() {
        let localstorageList = JSON.parse(localStorage.getItem("itemList"));

        for (let i = 0; i < localstorageList.length; i++) {
            let documentElement = document.getElementById("ls_delete_modals");
            let deleteModalHtml =
                `<div id="ls_item_delete_confirmation` + i + `" class="modal">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Delete Item</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cross">
                                    <span aria-hidden="true">X</span>
                                </button>

                            </div>
                            <div class="delete-modal-body" style="padding: 5%">
                                <center>
                                    <p>Do you really want to delete this item?</p>
                                    <p>This process will delete the item information and <b>cannot be undone</b>.</p>
                                </center>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="deleteLocalStorageItem(` + i + `)" data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>`;

            documentElement.insertAdjacentHTML("afterEnd", deleteModalHtml);
        }
    }

    function addDeleteModalForLocalStorageItem(i) {
        let documentElement = document.getElementById("ls_delete_modals");
        let deleteModalHtml =
            `<div id="ls_item_delete_confirmation` + i + `" class="modal">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Delete Item</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cross">
                            <span aria-hidden="true">X</span>
                            </button>

                        </div>
                        <div class="delete-modal-body" style="padding: 5%">
                            <center>
                                <p>Do you really want to delete this item?</p>
                                <p>This process will delete the item information and <b>cannot be undone</b>.</p>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="deleteLocalStorageItem(` + i + `)" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>`;

        documentElement.insertAdjacentHTML("afterbegin", deleteModalHtml);
    }

    // Deleting item from local storage
    function deleteLocalStorageItem(indexId) {
        clearTable(true);
        let localstorageList = JSON.parse(localStorage.getItem("itemList"));
        localstorageList.splice(indexId, 1);
        localStorage.setItem("itemList", JSON.stringify(localstorageList));
        generateTable();
    }

    // Called in addToCache.
    function refreshTable() {
        clearTable(false);
        generateTable();
    }

    // Clearing the table.  Hard clear = true, for clearing entire table.   False for just adding an item.
    function clearTable(isHardClear) {
        clearModals();
        itemList = JSON.parse(localStorage.getItem("itemList"));
        if (itemList != null) {
            if (isHardClear) {
                noOfAdded = itemList.length;
            } else {
                noOfAdded = itemList.length - 1;
            }
        } else {
            noOfAdded = 0;
        }

        if (noOfAdded > 0) {
            var elements = document.querySelectorAll('tr');

            for (let i = 0; i < noOfAdded; i++) {
                let last = elements[(elements.length - noOfAdded) + i];
                last.parentNode.removeChild(last);
            }
        }
    }


    // Clearing out existing modals for a fresh restart.
    function clearModals() {
        document.getElementById("ls_delete_modals").innerHTML = "";
    }


    // INITIAL LOAD SETUP.
    // Clearing out observedItemIndex if it exists.
    localStorage.removeItem("observedItemIndex");

    // Determines whether localStorage offline capacity is to be handled at the building and level/location.
    if((localStorage.getItem("building_name_for_itemList") == "<?= $currentprop_name ?>") && (localStorage.getItem("folder_name_for_itemList") == "<?= $folder_name ?>"))
    {
        setupTable();
    }
    else
    {
        // Warns users of unsaved item and does a redirect until items are cleared.
        if (localStorage.getItem("itemList") != null && localStorage.getItem("itemList") != "[]")
        {
            alert("You have unsaved item(s) in " + localStorage.getItem("folder_name_for_itemList") + " at building " + localStorage.getItem("building_name_for_itemList") + ".  Please save or discard those changes first.");
            window.location.href = "<?= $this->URL->build(['controller' => 'Properties', 'action' => 'dashboard', $property_id]) ?>";
        }
        // Sets the building name and folder name for the first time.  Occurs when itemList is empty.
        else
        {
            localStorage.setItem("building_name_for_itemList", "<?= $currentprop_name ?>");
            localStorage.setItem("folder_name_for_itemList", "<?= $folder_name ?>");
        }
    }

</script>


