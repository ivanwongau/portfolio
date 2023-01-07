<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link add active" aria-current="page" href="">
                <h4><b>Edit</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="
                <?= $this->Url->build(['controller' => 'Articles', 'action' => 'index']); ?>">
                <h4>Return to List</h4></a>
        </li>
    </ul>


    <div class="column-responsive column-80">
        <div class="articles form content">
            <?= $this->Form->create($article) ?>
            <fieldset>
                <legend><?= __('Edit Article') ?></legend>
                <?php
                    echo $this->Form->control('article_title', ['label' => 'Title']);
                    echo $this->Form->control('article_img', ['label' => 'Article Image']);
                    echo $this->Form->control('article_desc', ['label' => 'Description']);
                    echo $this->Form->control('article_detail', ['label' => 'Content']);
                    echo $this->Form->control('created_date');
                    echo $this->Form->control('user_id', ['default' => $this->Identity->get('id'), 'label' => '', 'hidden' => 'true']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
