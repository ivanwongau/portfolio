<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LotOwner $lotOwner
 */
?>

<div class="page-header lot-add">
    <?php echo  $this->Html->link(
        '<button class="btn btn-primary" style="margin-bottom:10px;"><i class="fas fa-arrow-left" ></i><span>  Back</span></button>',
        ['controller' => 'Properties', 'action' => 'dashboard', $property_id],
        ['escape' => false]
    ); ?>

</div>
<div class="section-a">
    <div></div>
    <div>
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <?= $this->Form->create($lotOwner) ?>

            <div class="lot-fields">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                    <label class="mdl-textfield__label" for="lots_no">Lot Number</label>
                    <input class="mdl-textfield__input" type="text" value="lot <?= $i ?>" name="lots_no<?= $i?>" readonly>
                </div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                    <label class="mdl-textfield__label" for="no_liabilities">No Liabilities</label>
                    <input class="mdl-textfield__input" type="number" value='' name="no_liabilities<?= $i?>" required="">
                </div>

                <hr class="solid" id="divider_add_lots" style="border-top:3px solid; visibility:hidden;">
            </div>

        <?php endfor; ?>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
    <div></div>
</div>