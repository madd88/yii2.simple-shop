<?php
/* @var $productInfo */

/* @var $productOptions */

use yii\helpers\Html;


$this->title = 'Main Page'
?>
<div class="card mt-4">
    <div class="card-body">
        <div class="row">


            <div class="col-md-2">
                <img class="card-img-top img-fluid" src="<?= $productInfo->img ?>" alt="" class="w-25">
            </div>
            <div class="col-md-9">
                <h4 class="card-title"><?= $productInfo->name ?></h4>
                <h5><?= $productInfo->price . '' . $productInfo->currency ?></h5>
                <a href="#" class="btn btn-primary btn-success mt-auto">В корзину</a>
                <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                4.0 stars
            </div>

        </div>
    </div>
    <div id="root"></div>

    <div id="root2"></div>
    <div class="card mt-4">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Описание</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Характеристики</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Отзывы</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active container"
                 id="home"><?= (!empty($productInfo->description)) ?: 'Описания пока нет' ?>
            </div>
            <div class="tab-pane container" id="menu1">
                <div class="products-options">

                <?php foreach ($productOptions as $option) : ?>
                <div class="row">
                        <div class="col-md-4">
                            <span data-toggle="tooltip" data-placement="top"
                                  title="<?= $option->options->description; ?>"><?= $option->options->name; ?></span>
                        </div>
                        <div class="col-md-7">
                            <?= $option->value; ?>
                        </div>
                </div>
                <?php endforeach; ?>
                </div>

            </div>
            <div class="tab-pane container" id="menu2">Отзывы</div>
        </div>
    </div>
</div>





