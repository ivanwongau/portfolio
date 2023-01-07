<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */

use Cake\ORM\TableRegistry;

echo $this->Html->css('primaryTable.css');

?>
<div class="row">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" style="display:inline-block;"
            <h4><b>View</b></h4>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'Articles', 'action' => 'index']); ?>>
                <h4>Return to List</h4>
            </a>
        </li>
    </ul>


    <div class="row">

        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <center>
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="<?= $article->article_img ?>" class="img-fluid"/>
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                </center>


                <?php
                $usersQuery = TableRegistry::getTableLocator()->get('Users');
                $user = $usersQuery->find()->select()->where(['id' => $article->user_id])->first();
                ?>

                <div class="card-body">
                    <h1 class="card-title fs-1 fw-bold"><?= h($article->article_title) ?></h1>
                    <div class="flex d-flex flex-row">
                        <h2>Author: <?=$user->first_name.' '.$user->surname?></h2>
                        <h3 class="ms-auto">Publish Date: <?= h($article->created_date) ?></h3>
                    </div>

                    <hr></hr>
                    <p class="card-text">
                        <?= nl2br($article->article_detail) ?>
                    </p>

                </div>

            </div>

        </div>

        <?php
        $articlesQuery = TableRegistry::getTableLocator()->get('Articles');
        $allArticles = $articlesQuery->find()->select()->all();

        $articleIds = [];
        foreach ($allArticles as $iteratedArticle) {
            array_push($articleIds, $iteratedArticle->id);
        }

        //debug($articleIds);

        $currentArticleIndex = $key = array_search($article->id, $articleIds);

        ?>


        <!-- Pagination -->
        <nav class="my-4" aria-label="..." onload="checkEdge()">
            <ul class="pagination pagination-circle justify-content-center">

                <!--Previous article-->
                <?php if ($currentArticleIndex - 1 != -1) { ?>
                    <li class="page-item pless">
                        <a class="page-link"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex - 1]]); ?>"
                           tabindex="-1"
                           aria-disabled="true">Previous</a>
                    </li>


                    <li class="page-item pless">
                        <a class="page-link"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex - 1]]); ?>">
                            <?= $currentArticleIndex ?>
                        </a>
                    </li>

                <?php } else { ?>
                    <li class="page-item pless" disabled="true">
                        <a class="page-link"
                           tabindex="-1"
                           aria-disabled="true">Previous</a>
                    </li>

                    <li class="page-item pless">
                        <a class="page-link"
                        >--</a>
                    </li>
                <?php } ?>


                <!--Current article-->
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">
                        <?= $currentArticleIndex+1 ?>
                        <span class="sr-only">(current)</span></a>
                </li>

                <!--Next article-->
                <?php if (($currentArticleIndex + 4 > count($articleIds)) != true) { ?>
                    <li class="page-item pmore">
                        <a class="page-link"
                           tabindex="+1"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 1]]); ?>">
                            <?= $currentArticleIndex + 2 ?>
                        </a>
                    </li>

                    <li class="page-item pmore">
                        <a class="page-link"
                           tabindex="+2"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 2]]); ?>">
                            <?= $currentArticleIndex + 3 ?>
                        </a>
                    </li>

                    <li class="page-item pmore">
                        <a class="page-link"
                           tabindex="+3"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 3]]); ?>">
                            <?= $currentArticleIndex + 4 ?>
                        </a>
                    </li>

                    <li class="page-item pmore">
                        <a class="page-link"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 1]]); ?>">Next</a>
                    </li>

                <?php } else if (( ($currentArticleIndex + 4) - count($articleIds) == 2 )) { ?>
                    <li class="page-item pmore">
                        <a class="page-link"
                           tabindex="+1"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 1]]); ?>">
                            <?= $currentArticleIndex + 2 ?>
                        </a>
                    </li>

                    <!-- <li class="page-item pmore">
                        <a class="page-link"
                           tabindex="+2"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 2]]); ?>">
                            <?= $currentArticleIndex + 2 ?>
                        </a>
                    </li> -->

            
                    <li class="page-item pmore">
                       
                        <a class="page-link"
                        
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 1]]); ?>">Next</a>
                    </li>

                    <!-- <li class="page-item pmore">
                        <a class="page-link">Next</a>
                    </li> -->

                <?php } else if (( ($currentArticleIndex + 4) - count($articleIds) == 1 )) {?>
                    <li class="page-item pmore">
                        <a class="page-link"
                           tabindex="+1"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 1]]); ?>">
                            <?= $currentArticleIndex + 2 ?>
                        </a>
                    </li>

                    <li class="page-item pmore">
                       
                        <a class="page-link"
                        
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 1]]); ?>">Next</a>
                    </li>

                
                <?php }else{ ?>
                    <li class="page-item pmore">
                        <a class="page-link">--</a>
                    </li>

            
                    <!-- <li class="page-item pmore">
                        <a class="page-link"
                           href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $articleIds[$currentArticleIndex + 1]]); ?>">Next</a>
                    </li> -->

                    <li class="page-item pmore">
                        <a class="page-link">Next</a>
                    </li>

                
                <?php }?>


            </ul>
        </nav>

        
    </div>
