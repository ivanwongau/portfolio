<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
?>

<style>
body {
    background-color: #F0F2F8;
}

.textfield {
    padding: 0 10px;
    display: grid;
    grid-template-rows: 1fr 1fr;
    margin-bottom: 10px;
}

.textfield #height,
.textfield #width {
    margin-top: 10px;
}

.measurement-tool #extraField {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
}

.measurement-tool .extraFieldlm {
    display: grid;
    grid-template-rows: 1fr 2fr;
}

.measurement-tool #extraField .algebra {
    align-self: center;
    justify-self: start;
    margin-left: 10px;
    margin-top: 10px;
}


.measurement-tool-header {
    display: grid;
    grid-template-columns: 5fr 1fr;
    margin-bottom: 10px;
}

.measurement-tool .data-field {
    display: grid;
    grid-template-columns: 1fr 1fr;
    margin-bottom: 10px;

}

.measurement-tool .data-field .textfield {
    padding: 0 10px;
    display: grid;
    grid-template-rows: 1fr 1fr;
}


.measurement-tool-result button {
    margin-top: 10px;

}

.measurement-tool .extraFieldlm .textfield {}
</style>
<p id="finalized" style="display:none;"><?= $finalized ?></p>

<div class="item_index_content" style="background-color:#F0F2F8;">
    <div class="container-fluid item_index">
        <div class="row" style="margin-top:100px;">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"> </div>
            <div class="col-lg-4"></div>

        </div>


        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-5">
                <?php echo  $this->Html->link(
                    '<button class="btn btn-secondary" style="margin-bottom:10px;"><span>Back</span></button>',
                    ['action' => 'index', $folder_id, $property_id, $folder_name, $currentprop_name],
                    ['escape' => false]
                ); ?>
                <?= $this->Form->create($item) ?>
                <fieldset>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="item_name">Item Name</label>
                        <input class="form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                            title="Please only enter alphabetical characters, 1-50 characters" id="item_name"
                            name="item_name" value='<?= h($item->item_name) ?>' required="" readonly>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="item_unit_of_mes">Edit Unit Of Measurement</label>
                        <select class="mdl-textfield__input form-control" id="item_unit_of_mes" name="item_unit_of_mes"
                            required="" readonly onchange="measurementTool(this.value);">
                            <option value="<?= h($item->item_unit_of_mes) ?>"><?= h($item->item_unit_of_mes) ?></option>
                            <option value="m2">m2</option>
                            <option value="L/M or No">L/M or No</option>
                            <option value="Ea">Ea</option>
                        </select>

                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="item_quantity">Edit Item quantity</label>
                        <input class="form-control" type="number" max="100000" min="1" step="0.01" id="item_quantity"
                            name="item_quantity" value='<?= h($item->item_quantity) ?>' required="" readonly
                            onchange="calculateItemTotalCost()">
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

                        <div class="data-field" id="new-field-section">
                        </div>

                        <div class="data-field">
                            <div class="height-field textfield">
                                <select class="textfield-input form-control" id="" name="">
                                    <option value="">Height</option>
                                    <option value="">Length</option>
                                </select>
                                <input class="form-control" type="number" max="100000" step="0.01" min="0" id="height"
                                    name="" value="">
                            </div>
                            <div class="width-field textfield">
                                <select class="textfield-input form-control" id="" name="">
                                    <option value="">Width</option>
                                    <option value="">Depth</option>
                                </select>
                                <input class="form-control" type="number" max="100000" min="0" step="0.01" id="width"
                                    name="" value="">
                            </div>
                        </div>

                        <div class="measurement-tool-result">
                            <div class="textfield">
                                <label class="textfield-label" for="">Result</label>
                                <input class="form-control" type="number" id="result" name="" readonly>
                            </div>

                            <button type="button" class="btn btn-primary"
                                onclick="calculateItemArea()">Calculate</button>
                        </div>
                        <hr class="solid" id="divider_add_item" style="border-top:1px solid;">

                    </div>
                    <!-- end of measurement Tool / area calculator -->

                    <!-- Measurement Tool / L/M calculator -->
                    <div id="lm-calculator" style="display:none" class="measurement-tool">
                        <hr class="solid" id="divider_add_item" style="border-top:1px solid;">

                        <div class="measurement-tool-header">
                            <h4>Measurement Tool Area</h4>
                            <button type="button" class="btn btn-primary" onclick="addMeasureFieldLength()">
                                Add
                            </button>
                        </div>

                        <div id="lm-new-fields">
                            <div id="new-field-sectionlm"></div>
                        </div>

                        <div class="data-field">

                            <div class="textfield">
                                <label class="textfield-label" for="">Length/No</label>

                                <input class="form-control" type="number" max="100000" min="0" step="0.01" id="length"
                                    name="" value="">
                            </div>

                        </div>

                        <div class="measurement-tool-result">
                            <div class="textfield">
                                <label class="textfield-label" for="">Result</label>
                                <input class="form-control" type="number" id="resultlm" name="" readonly>
                            </div>

                            <button type="button" class="btn btn-primary"
                                onclick="calculateItemLength()">Calculate</button>
                        </div>

                        <hr class="solid" id="divider_add_item" style="border-top:1px solid;">

                    </div>
                    <!-- end of measurement Tool / L/M calculator -->


                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="item_rate">Item Rate</label>
                        <input class="form-control" type="number" max="999999999999" min="0" step="0.01" id="item_rate"
                            name="item_rate" value='<?= h($item->item_rate) ?>' required=""
                            oninput="calculateItemTotalCost()">
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="item_total">Item Total Cost</label>
                        <input class="form-control" type="number" id="item_total" name="item_total"
                            value='<?= h($item->item_total) ?>' required="" readonly>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="item_condition">Item Condition</label>
                        <select class="form-control" id="item_condition" name="item_condition" required="">
                            <option value="<?= h($item->item_condition) ?>"><?= h($item->item_condition) ?></option>
                            <option value="Brand_New">Brand New</option>
                            <option value="Good">Good</option>
                            <option value="okay">okay</option>
                            <option value="Operational">Operational</option>
                            <option value="Needs repair">Needs repair</option>
                            <option value="Broken">Broken</option>
                        </select>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="item_allowance">Action</label>
                        <select class="form-control" id="item_allowance" name="item_allowance" required="">
                            <option value="<?= h($item->item_allowance) ?>"><?= h($item->item_allowance) ?></option>
                            <option value="Replacement">Replacement</option>
                            <option value="Upgrade">Upgrade</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="expected_life">Expected Life</label>
                        <input class="form-control" type="number" max="100" min="0" id="expected_life"
                            value='<?= h($item->expected_life) ?>' name="expected_life" required="">
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="year_due">Year Due</label>
                        <input class="form-control" type="number" max="100" min="1" id="year_due" name="year_due"
                            value='<?= h($item->year_due) ?>' required="" oninput="calculateExpectedYeearDue()">
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="oriDate">Inspection Date</label>
                        <input class="form-control" type="text" id="oriDate" name="oriDate"
                            value='<?= $propertyspec->first()->property_date->i18nFormat('yyyy') ?>' readonly>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="expected_year_due">Expected Year Due</label>
                        <input class="form-control" type="text" id="expected_year_due" name="expected_year_due"
                            value="<?= h($item->expected_year_due) ?>" readonly>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                        <label class="mdl-textfield__label" for="">Folder Name</label>
                        <input class="form-control" type="Text" id="" name="" required="" value="<?= h($folder_name) ?>"
                            readonly>
                    </div>
                    <br>

                </fieldset>

                <button type="submit" class="btn btn-primary">Submit </button>
                <?= $this->Form->end() ?>
                <br>

                <?php echo $this->Html->link(__('Add Item Photo'), ['controller' => 'ItemImages', 'action' => 'add', $item->id, $item->folder_id, $property_id, $item->item_name, $currentprop_name], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-lg-3"></div>

        </div>
    </div>
</div>
