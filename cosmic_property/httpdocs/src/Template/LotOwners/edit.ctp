<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LotOwner $lotOwner
 */
?>
<p id="num_of_lot" style="display: none;"><?= $number_of_lot ?></p>
<p id="remaining_liabilities_forJs" style="display: none;"><?= $number_of_lot_liabilities ?></p>



<div class="page-header lot-add">
    <?php echo  $this->Html->link(
        '<button class="btn btn-primary" style="margin-bottom:10px;"><i class="fas fa-arrow-left" ></i><span>  Back</span></button>',
        ['controller' => 'Properties', 'action' => 'dashboard', $property_id],
        ['escape' => false]
    ); ?>

</div>
<div class="section-a">
    <div>


    </div>
    <div>
        <h3 id="remaining_liabilities">Remaining Liabilities: <?= $number_of_lot_liabilities ?></h3>

        <?php for ($i = 0; $i < count($lotOwner); $i++) : ?>
        <?= $this->Form->create($lotOwner) ?>

        <div class="lot-fields">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                <label class="mdl-textfield__label" for="lots_no">Lot Number</label>
                <input class="mdl-textfield__input" type="text" value="<?= $lotOwner[$i]['lots_no'] ?>"
                    name="lots_no[<?= $i ?>]" readonly>
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                <label class="mdl-textfield__label" for="no_liabilities">No Liabilities</label>
                <input class="mdl-textfield__input" type="number" step="0.01"
                    value='<?= $lotOwner[$i]['no_liabilities'] ?>' name="no_liabilities[<?= $i ?>]"
                    id="no_liabilities[<?= $i ?>]" onchange="liabilitiesCalculation()">
            </div>

            <hr class="solid" id="divider_add_lots" style="border-top:3px solid; visibility:hidden;">
        </div>

        <?php endfor; ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
    <div></div>
</div>