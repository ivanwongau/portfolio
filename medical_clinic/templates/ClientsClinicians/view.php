<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsClinician $clientsClinician
 */
?>
<?php if($this->Identity->get('role')==='2'||$this->Identity->get('role')==='1'){

?>


<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Clients Clinician'), ['action' => 'edit', $clientsClinician->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Clients Clinician'), ['action' => 'delete', $clientsClinician->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsClinician->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Clients Clinicians'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Clients Clinician'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clientsClinicians view content">
            <h3><?= h($clientsClinician->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $clientsClinician->has('client') ? $this->Html->link($clientsClinician->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsClinician->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Clinician') ?></th>
                    <td><?= $clientsClinician->has('clinician') ? $this->Html->link($clientsClinician->clinician->id, ['controller' => 'Clinicians', 'action' => 'view', $clientsClinician->clinician->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($clientsClinician->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
    <?php
}
?>
