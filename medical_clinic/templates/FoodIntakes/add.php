<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FoodIntake $foodIntake
 */
    use Cake\ORM\TableRegistry;

?>
<div class="row">

    <div class="topTabBar">
        <br>
        <h1>Log your food intakes</h1>
        <br><br>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"><h4><b>Add</b></h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=
                    <?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'index']); ?>>
                    <h4>List</h4></a>
            </li>
        </ul>
    </div>



    <?php if($this->Identity->get('role') === '3') {

            $userId = $this->Identity->get('id');

            $clientQuery = TableRegistry::getTableLocator()->get('Clients');
            $clientId = $clientQuery->find()->select([])->where(['user_id' => $userId])->firstOrFail()->id;
            $clientIdArray = [$clientId]
        ?>

        <div class="column-responsive column-80">
            <div class="foodIntakes form content">
                <?= $this->Form->create($foodIntake) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('client_id', ['default' => $clientId, 'hidden' => 'true', 'label' => '']);
                    echo $this->Form->control('food_eaten');
                    echo $this->Form->control('logged_time');
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
    <?php } ?>



</div>
<br><br><br>

