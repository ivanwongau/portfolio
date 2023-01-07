<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Education $education
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Education'), ['action' => 'edit', $education->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Education'), ['action' => 'delete', $education->id], ['confirm' => __('Are you sure you want to delete # {0}?', $education->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Education'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Education'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="education view content">
            <h3><?= h($education->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Video Title') ?></th>
                    <td><?= h($education->video_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Video Desc') ?></th>
                    <td><?= h($education->video_desc) ?></td>
                </tr>
                <tr>
                    <th><?= __('Video Img') ?></th>
                    <td><?= h($education->video_img) ?></td>
                </tr>
                <tr>
                    <th><?= __('Video Url') ?></th>
                    <td><?= h($education->video_url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($education->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($education->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= h($education->user_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
