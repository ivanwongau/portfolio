<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinician $clinician
 */
use Cake\ORM\TableRegistry;

echo $this->Html->css('primaryTable.css');
?>

<?php if($this->Identity->get('role')==='2'||$this->Identity->get('role')==='1'){

?>


<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link add active" aria-current="page" href="">
                <h4><b>Edit</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=
                <?= $this->Url->build(['controller' => 'Clinicians', 'action' => 'index']); ?>>
                <h4>Return to List</h4></a>
        </li>
    </ul>

    <div class="column-responsive column-80">
        <div class="clinicians form content">
            <?= $this->Form->create($clinician) ?>
            <fieldset>
                <?php
                $usersQuery = TableRegistry::getTableLocator()->get('Users');
                $user = $usersQuery->find()->select([])->where(['id' => $clinician->user_id])->first();
                ?>
                <legend><?=$user->first_name.' '.$user->surname?></legend>
                <?php
                    echo $this->Form->control('medical_specialty');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

    <?php
}
?>
