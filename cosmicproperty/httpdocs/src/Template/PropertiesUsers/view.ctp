<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertiesUser $propertiesUser
 */
?>

    <h3><?= h($buildingsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $buildingsUser->has('user') ? $this->Html->link($buildingsUser->user->id, ['controller' => 'Users', 'action' => 'view', $buildingsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Building') ?></th>
            <td><?= $buildingsUser->has('building') ? $this->Html->link($buildingsUser->property->property_name, ['controller' => 'Properties', 'action' => 'view', $buildingsUser->property->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($buildingsUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Access Level') ?></th>
            <td><?= $this->Number->format($buildingsUser->access_level) ?></td>
        </tr>
    </table>
