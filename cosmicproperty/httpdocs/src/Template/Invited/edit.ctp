<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invited $invited
 */
?>

<div class="pc-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Access Control</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'profile']) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo $this->Url->build(['controller'=>'properties','action'=>'buildinglist']) ?>">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="javascript:history.go(-1);">Related User</a></li>
                            <li class="breadcrumb-item">Edit Invited</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?= $this->Form->create($invited) ?>
        <form>
            <h3 class="mt-3">Edit Invited</h3>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo $this->Form->control('email',array('class'=>'form-control'));?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo $this->Form->hidden('property_id', ['class' => 'form-control','options' => $properties]);?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label >Access Level</label>
                    <?php if ($access_level == 1) {
                        echo $this->Form->select('access_level', [
                            '0' => 'Subscription Management',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5'],
                            array('type' => 'text', 'class' => 'form-control','empty'=>'choose one'));
                    } else if ($access_level == 0) {
                        echo $this->Form->select('access_level', [
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5'],
                            array('type' => 'text', 'class' => 'form-control','empty'=>'choose one'));
                    } else if ($access_level == 2) {
                        echo $this->Form->select('access_level', [
                            '3' => '3',
                            '4' => '4',
                            '5' => '5'],
                            array('type' => 'text', 'class' => 'form-control','empty'=>'choose one'));
                    } ?>
                </div>
            </div>
            <div class="d-flex">
                <div class="p-2">
                    <?php echo $this->Form->button('Back', ['type' => 'button', 'onclick' => 'history.back ()', 'class' => 'btn  btn-secondary']); ?>
                </div>
                <div class="ml-auto p-2">
                    <?= $this->Form->button('Submit', ['class' => 'btn  btn-primary','controller' => 'invited', 'action' => 'add']) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </form>
    </div>
</div>
