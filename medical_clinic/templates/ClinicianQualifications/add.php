<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClinicianQualification $clinicianQualification
 */
?>
<?php if($this->Identity->get('role')==='2'||$this->Identity->get('role')==='1'){

?>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link add active" aria-current="page" href="">
                <h4><b>Add</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=
                <?= $this->Url->build(['controller' => 'ClinicianQualifications', 'action' => 'view']); ?>>
                <h4>Return to List</h4></a>
        </li>
    </ul>


    <div class="column-responsive column-80">
        <div class="clinicianQualifications form content">
            <?= $this->Form->create($clinicianQualification) ?>
            <fieldset>
                <legend><?= __('Add Clinician Qualification') ?></legend>
                <?php
                    echo $this->Form->control('qualification');
                    echo $this->Form->control('date_expire');
                    echo $this->Form->control('clinician_id', ['options' => $clinicians]);
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
