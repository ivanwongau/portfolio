<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyMultiOwnership $propertyMultiOwnership
 */
?>
<div class="property_add content">
    <div class="container-fluid property_add">
        <div class="text-field">

            <br>

            <?= $this->Form->create($propertyMultiOwnership) ?>
            <fieldset>
                <legend><?= __('Edit Property Multi Ownership') ?></legend>

                <label class="textfield-label" for="owner_corp_num">Owner Corp Number</label>
                <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                       title="Please only enter alphabetical characters, 1-50 characters" id="owner_corp_num"
                       name="owner_corp_num" required="" maxlength="30" value="<?= $propertyMultiOwnership->owner_corp_num ?>">

                <label class="textfield-label" for="Num_of_lot">Number of Lots</label>
                <input class="textfield-input form-control" type="number" id="Num_of_lot"
                       name="Num_of_lot" required="" maxlength="10" value="<?= $propertyMultiOwnership->Num_of_lot ?>">

                <label class="textfield-label" for="strata_plan_number">Strata Plan Number</label>
                <input class="textfield-input form-control" type="text" pattern="[A-Za-z0-9. -]{1,50}"
                       title="Please only enter alphabetical characters, 1-50 characters" id="strata_plan_number"
                       name="strata_plan_number" required="" maxlength="30" value="<?= $propertyMultiOwnership->strata_plan_number ?>">

                <label class="textfield-label" for="Num_of_lot_liabilities">Number of Lot Liabilities</label>
                <input class="textfield-input form-control" type="number" id="Num_of_lot_liabilities"
                       name="Num_of_lot_liabilities" required="" maxlength="30" value="<?= $propertyMultiOwnership->Num_of_lot_liabilities ?>">

            </fieldset>
            <button type="submit" class="btn btn-primary">Submit</button>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
