<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientCondition $clientCondition
 */
use Cake\ORM\TableRegistry;
?>


<div class="row">

    <div class="topTabBar">
        <br>
        <h1>Log your current medical condition</h1>
        <br><br>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"><h4><b>Add</b></h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=
                    <?= $this->Url->build(['controller' => 'ClientConditions', 'action' => 'index']); ?>>
                    <h4>List</h4></a>
            </li>
        </ul>
    </div>

</div>


    <?php if($this->Identity->get('role') === '3') {
        $userId = $this->Identity->get('id');

        $clientQuery = TableRegistry::getTableLocator()->get('Clients');
        $clientId = $clientQuery->find()->select([])->where(['user_id' => $userId])->firstOrFail()->id;
        $clientIdArray = [$clientId]
    ?>

    <div class="column-responsive column-80">
        <div class="clientConditions form content">
            <?= $this->Form->create($clientCondition) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('insulin_level');
                    echo $this->Form->control('weight');
                    echo $this->Form->control('BMI');
                    echo $this->Form->control('logged_time');
                    echo $this->Form->control('client_id', ['default' => $clientId, 'hidden' => 'true', 'label' =>'']);
                ?>
            </fieldset>
            <br><br>
            <a style="float: right;">
                <?= $this->Form->button(__('Submit')) ?>
            </a>
            <?= $this->Form->end() ?>
            <br><br>
        </div>
    </div>
</div>

<?php } ?>

<?php if($this->Identity->get('role') === '2') {
    ?>

    <div class="column-responsive column-80">
        <div class="clientConditions form content">
            <?= $this->Form->create($clientCondition) ?>
            <fieldset>
                <?php
                echo $this->Form->control('insulin_level');
                echo $this->Form->control('weight');
                echo $this->Form->control('BMI');
                echo $this->Form->control('logged_time');
                echo $this->Form->control('client_id', ['options' => $clients]);
                ?>
            </fieldset>
            <br><br>
            <a style="float: right;">
                <?= $this->Form->button(__('Submit')) ?>
            </a>
            <?= $this->Form->end() ?>
            <br><br>
        </div>
    </div>
    </div>

<?php } ?>

<?php if($this->Identity->get('role') === '1') {
    ?>
    <div class="column-responsive column-80">
        <div class="clientConditions form content">
            <?= $this->Form->create($clientCondition) ?>
            <fieldset>
                <?php
                echo $this->Form->control('insulin_level');
                echo $this->Form->control('weight');
                echo $this->Form->control('BMI');
                echo $this->Form->control('logged_time');
//                echo $this->Form->control('client_id', ['options' => $clients, 'hiddenField' => true, 'type' => 'hidden']);
                echo $this->Form->control('client_id', ['options' => $clients]);
                ?>
            </fieldset>
            <br><br>
            <a style="float: right;">
                <?= $this->Form->button(__('Submit')) ?>
            </a>
            <?= $this->Form->end() ?>
            <br><br>
        </div>
    </div>
    </div>

<?php } ?>


<br><br>

