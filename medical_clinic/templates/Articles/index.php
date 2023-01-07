<?php

use Cake\ORM\TableRegistry;

echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');
?>

<!DOCTYPE html>
<html lang="utf-8">
<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link href="/team19/webroot/bootstrap5.0/css/bootstrap.min.css" rel="stylesheet">

<?php if ($this->Identity->get('role') == "1" ){ ?>
    <div>
        <?= $this->Html->link(__('Add new article'), ['controller' => 'Articles', 'action' => 'add'], ['class' => 'button float-right']) ?>
    </div>
<?php } ?>


<header class="d-flex justify-content-center">
    <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Education', 'action' => 'index']); ?>" class="nav-link ">Videos</a></li>
        <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'learn']); ?>" class="nav-link active">Articles</a></li>
    </ul>
</header>

<div class="container" style="height:800rpx">

    <div class="row" >

        <?php foreach ($articles as $key => $articles):  ?>

            <div class="col-lg-3 col-md-12 pt-2">
                <div class="card single_post">
                    <div class="body">
                        <h3 class="card-header"><?= $articles->article_title ?></h3>

                        <?php if($this->Identity->get('role') == '1' || $this->Identity->get('role') == '2') { ?>
                            <div class="clinicianLinksDiv" style="float: right">
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $articles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id)]) ?>
                            </div>
                        <?php } ?>

                        <!-- video  description -->
                        <div class="card-body">
                            <h5  class="card-title flex "> Description: <h6 class="card-subtitle text-muted flex"><?= $articles->article_desc ?></h6></h5>
                        </div>

                    </div>

                    <div class="body">
                        <?php if ($articles->article_img != null) {
                            ?>
                            <img class="d-block user-select-none" src="<?= $articles->article_img ?>" width="100%" height="180"
                                 aria-label="Placeholder: Image cap" focusable="false" role="img"
                                 preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180"
                                 style="font-size:1.125rem;text-anchor:middle">
                            <?php
                        } ?>

                        <div class="linksDiv" style="float: right">
                            <a href="articles/view/<?= $articles->id ?>" title="read more" class="button btn-sm pinkButtons">Read More</a>
                        </div>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>

    </div>
</div>

</html>
