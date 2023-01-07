<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FoodIntake $foodIntake
 */
?>
<?php if($this->Identity->get('role')==='2'||$this->Identity->get('role')==='1'){

?>
<div class="topTabBar">
    <br>
    <h1>Edit your food intakes</h1>
    <br><br>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'index', $foodIntake->id]); ?>>
                <h4>View</h4>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'edit', $foodIntake->id]); ?>>
                <h4><b>Edit</b></h4>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'index']); ?>>
                <h4>List</h4></a>
    </ul>
</div>


<div class="row">
    <div class="column-responsive column-80">
        <div class="foodIntakes form content">
            <h4 style="float: right">
                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $foodIntake->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $foodIntake->id)]
                ) ?>
            </h4>

            <?= $this->Form->create($foodIntake) ?>
            <fieldset>
                <legend><?= __('Edit Food Intake') ?></legend>
                <?php
                    echo $this->Form->control('client_id', ['options' => $clients, 'type' => 'hidden']);
                    echo $this->Form->control('food_eaten');
                    echo $this->Form->control('logged_time');
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
