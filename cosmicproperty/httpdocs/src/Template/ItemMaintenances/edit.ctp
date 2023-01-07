<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemMaintenance $itemMaintenance
 */
?>
<div class="item-table-card">
    <div class="table-container">
        <button class="btn btn-secondary" style="margin-bottom:10px;" onclick="window.history.back()">Back</button>

        <?= $this->Form->create($itemMaintenance) ?>
        <h2><?= __('Edit Item Maintenance') ?></h2>

        <div class="item-name-field textfield">
            <label class="textfield-label" for="item_name">Item Name</label>
            <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                   title="Please only enter alphabetical characters, 1-50 characters" id="item_name"
                   name="item_name" required="" maxlength="30" value="<?= $itemMaintenance->item_name ?>">
        </div>
        <div class="item-status-field textfield">
            <label class="textfield-label" for="item_status">Status</label>
            <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                   title="Please only enter alphabetical characters, 1-50 characters" id="item_status"
                   name="item_status" required="" maxlength="30" value="<?= $itemMaintenance->item_status ?>">
        </div>
        <div class="item-location-field textfield">
            <label class="textfield-label" for="item_location">Location</label>
            <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                   title="Please only enter alphabetical characters, 1-50 characters" id="item_location"
                   name="item_location" required="" maxlength="30" value="<?= $itemMaintenance->item_location ?>">
        </div>
        <div class="item-finding-field textfield">
            <label class="textfield-label" for="item_finding">Findings</label>
            <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                   title="Please only enter alphabetical characters, 1-50 characters" id="item_finding"
                   name="item_finding" required="" maxlength="100" value="<?= $itemMaintenance->item_finding ?>">
        </div>
        <div class="item-recommendation-field textfield">
            <label class="textfield-label" for="item_finding">Recommendation</label>
            <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                   title="Please only enter alphabetical characters, 1-50 characters" id="item_recommendation"
                   name="item_recommendation" required="" maxlength="100" value="<?= $itemMaintenance->item_recommendation ?>">
        </div>
        <div class="cost-estimate-field textfield">
            <label class="textfield-label" for="item_finding">Cost Estimate</label>
            <input class="textfield-input form-control" type="number"
                   title="Please only enter alphabetical characters, 1-50 characters" id="cost_estimate"
                   name="cost_estimate" required="" value="<?= $itemMaintenance->cost_estimate ?>">
        </div>
        <div class="potential-hazard-field textfield">
            <label class="textfield-label" for="item_finding">Potential Hazard</label>
            <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                   title="Please only enter alphabetical characters, 1-50 characters" id="potential_hazard"
                   name="potential_hazard" required="" maxlength="100" value="<?= $itemMaintenance->potential_hazard ?>">
        </div>
        <div class="item-priority-field textfield">
            <label class="textfield-label" for="item_finding">Item Priority</label>
            <input class="textfield-input form-control" type="number"
                   title="Please only enter alphabetical characters, 1-50 characters" id="item_priority"
                   name="item_priority" required="" value="<?= $itemMaintenance->item_priority ?>">
        </div>


        <br>

        <button type="submit" class="btn btn-primary">Submit</button>

        <?= $this->Form->end() ?>

    </div>
</div>
