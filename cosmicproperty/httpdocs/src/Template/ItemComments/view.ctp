<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemComment $itemComment
 */
?>

<div class="itemComments view large-9 medium-8 columns content">
    <h3><?= h($itemComment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Content') ?></th>
            <td><?= h($itemComment->content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create Date') ?></th>
            <td><?= h($itemComment->create_date) ?></td>
        </tr>
    </table>
</div>
