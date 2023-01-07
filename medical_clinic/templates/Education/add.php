<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Education $education
 */
?>
<?php if($this->Identity->get('role')==='2'||$this->Identity->get('role')==='1'){

    ?>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link add active" aria-current="page" href="
                <?= $this->Url->build(['controller' => 'Education', 'action' => 'add']); ?>">
                <h4><b>Add</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="
                <?= $this->Url->build(['controller' => 'Education', 'action' => 'index']); ?>">
                <h4>Return to List</h4></a>
        </li>
    </ul>

    <div class="column-responsive column-80">
        <div class="education form content">
            <?= $this->Form->create($education) ?>
            <fieldset>
                <legend>Add Educational Video</legend>
                <?php
                    echo $this->Form->control('video_title', ['label' => 'Title']);
                    echo $this->Form->control('video_desc', ['label' => 'Description']);
                    echo $this->Form->control('video_img', ['label' => 'Placeholder Image (Optional)']);
                    echo "To add a video image, please copy the image address from the internet.";
                    echo $this->Form->control('video_url');
                    echo "To add a video, please copy the youtube video address from the Monash Health youtube channel.";
                    echo $this->Form->control('created_date');
                    echo $this->Form->control('user_id', ['default' => $this->Identity->get('id'), 'label' => '', 'hidden' => 'true']);
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
