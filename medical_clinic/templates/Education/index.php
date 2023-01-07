<?php

use Cake\ORM\TableRegistry;

echo $this->Html->css('monashHealth-styles.css');
echo $this->Html->css('primaryTable.css');
?>

<!DOCTYPE html>
<html lang="utf-8">
<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link href="/team19/webroot/bootstrap5.0/css/bootstrap.min.css" rel="stylesheet">


<?php if ($this->Identity->get('role') == "1") { ?>
    <div>
        <?= $this->Html->link(__('Add new video'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    </div>
<?php } ?>


<header class="d-flex justify-content-center">
    <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Education', 'action' => 'index']); ?>"
                                class="nav-link active">Videos</a></li>
        <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'index']); ?>"
                                class="nav-link">Articles</a></li>
    </ul>
</header>


<div class="container" style="height:800rpx">

    <div class="row">

        <?php foreach ($education as $key => $education): ?>
            <div class="col-sm-6 col-md-4 videoContainer">

                <h3 class="card-header"><?= $education->video_title ?></h3>

                <!-- if wnat the clinian to edit the video -->
                <!-- || $this->Identity->get('role') == '2') -->
                <?php if ($this->Identity->get('role') == '1'){ ?>
                    <div class="clinicianLinksDiv" style="float: right">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $education->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $education->id], ['confirm' => __('Are you sure you want to delete # {0}?', $education->video_title)]) ?>
                    </div>
                <?php } ?>

                <!-- <?php if ($education->video_img != null) {
                    ?>
                    <img class="d-block user-select-none" src="<?= $education->video_img ?>" width="100%" height="180"
                         aria-label="Placeholder: Image cap" focusable="false" role="img"
                         preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180"
                         style="font-size:1.125rem;text-anchor:middle">
                    <?php
                } ?> -->


                <!-- education page video description -->
                <!-- <div class="card-body">
                    <h5 class="card-title flex "> Description: <h6
                            class="card-subtitle text-muted flex"><?= $education->video_desc ?></h6></h5>
                </div> -->

                <?php
                $videoUrl = $education->video_url;
                $converedUrl = str_replace("watch?v=", "embed/", $videoUrl);
                ?>
                <div class="embed-responsive embed-responsive-16by9 py-2">
                    <iframe class="embed-responsive-item" width="100%" height="200" style="width=100%"
                            src="<?php echo $converedUrl; ?>" allowfullscreen></iframe>
                </div>


                <div class="linksDiv" style="float: right">
                    <a href="<?= $education->video_url ?>" class="button btn-sm pinkButtons">on YouTube</a>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>


</html>



<script>
    .blog - page.single_post
    {
        -webkit - transition
    :
        all
        .4
        s
        ease;
        transition: all
        .4
        s
        ease
    }

    .blog - page.single_post.img - post
    {
        position: relative;
        overflow: hidden;
        max - height
    :
        500
        px
    }

    .blog - page.single_post.img - post > img
    {
        -webkit - transform
    :
        scale(1);
        -ms - transform
    :
        scale(1);
        transform: scale(1);
        opacity: 1;
        -webkit - transition
    :
        -webkit - transform
        .4
        s
        ease, opacity
        .4
        s
        ease;
        transition: transform
        .4
        s
        ease, opacity
        .4
        s
        ease;
        max - width
    :
        100 %;
        filter: none;
        -webkit - filter
    :
        grayscale(0);
        -webkit - transform
    :
        scale(1.01)
    }

    .blog - page.single_post.img - post
    :
    hover
    img
    {
        -webkit - transform
    :
        scale(1.02);
        -ms - transform
    :
        scale(1.02);
        transform: scale(1.02);
        opacity: .7;
        filter: gray;
        -webkit - filter
    :
        grayscale(1);
        -webkit - transition
    :
        all
        .8
        s
        ease - in -out
    }

    .blog - page.single_post.img - post
    :
    hover.social_share
    {
        display: block
    }

    .blog - page.single_post.img - post.social_share
    {
        position: absolute;
        bottom: 10
        px;
        left: 10
        px;
        display: none
    }

    .blog - page.single_post.meta
    {
        list - style
    :
        none;
        padding: 0;
        margin: 0
    }

    .blog - page.single_post.meta
    li
    {
        display: inline - block;
        margin - right
    :
        15
        px
    }

    .blog - page.single_post.meta
    li
    a
    {
        font - style
    :
        italic;
        color: #959595;
        text - decoration
    :
        none;
        font - size
    :
        12
        px
    }

    .blog - page.single_post.meta
    li
    a
    i
    {
        margin - right
    :
        6
        px;
        font - size
    :
        12
        px
    }

    .blog - page.single_post
    h3
    {
        font - size
    :
        20
        px;
        line - height
    :
        26
        px;
        -webkit - transition
    :
        color
        .4
        s
        ease;
        transition: color
        .4
        s
        ease
    }

    .blog - page.single_post
    h3
    a
    {
        color: #242424;
        text - decoration
    :
        none
    }

    .blog - page.single_post
    p
    {
        font - size
    :
        15
        px
    }

    .blog - page.single_post.blockquote
    p
    {
        margin - top
    :
        0
        !important
    }

    .blog - page.right - box.categories - clouds
    li
    {
        display: inline - block;
        margin - bottom
    :
        5
        px
    }

    .blog - page.right - box.categories - clouds
    li
    a
    {
        display: block;
        font - size
    :
        14
        px;
        border: 1
        px
        solid
        #ccc;
        padding: 6
        px
        10
        px;
        border - radius
    :
        3
        px;
        color: #242424
    }

    @media(max - width:
    414
    px
    )
    {
    .
        section.blog - page
        {
            padding: 20
            px
            0
        }
    .
        blog - page.left - box.single - comment - box > ul > li
        {
            padding: 25
            px
            0
        }
    .
        blog - page.left - box.single - comment - box
        ul
        li.icon - box
        {
            display: inline - block
        }
    .
        blog - page.left - box.single - comment - box
        ul
        li.text - box
        {
            display: block;
            padding - left
        :
            0;
            margin - top
        :
            10
            px
        }
    }
    .card
    {
        background: #fff;
        margin - bottom
    :
        30
        px;
        transition: .5
        s;
        border: 0;
        border - radius
    :
        .55
        rem;
        position: relative;
        width: 100 %;
        box - shadow
    :
        0
        1
        px
        2
        px
        0
        rgba(0, 0, 0, 0.1);
    }

    .card.body
    {
        font - size
    :
        14
        px;
        color: #424242;
        padding: 20
        px;
        font - weight
    :
        400;
    }
    .card.header
    {
        color: #424242;
        padding: 20
        px;
        position: relative;
        box - shadow
    :
        none;
    }
    .card.header
    h2
    {
        font - size
    :
        15
        px;
        color: #757575;
        position: relative;
    }
    .card.header
    h2:before
    {
        background: #a27ce6;
    }
    .card.header
    h2::before
    {
        position: absolute;
        width: 20
        px;
        height: 1
        px;
        left: 0;
        top: -20
        px;
        content: '';
    }
    .m - b - 15
    {
        margin - bottom
    :
        15
        px;
    }
</script>
