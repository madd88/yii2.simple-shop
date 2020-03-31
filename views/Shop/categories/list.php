<?php
/* @var $categoryList */

use yii\helpers\Html;
use yii\bootstrap4\LinkPager;


$this->title = 'Main Page'
?>
    <h1></h1>
    <div class="row">

        <?php foreach ($categoryList as $category): ?>

            <div class="col-lg-3 col-md-6 mb-2">
                <div class="card h-100">
                    <!-- Изображение -->
                    <img class="card-img-top category-img"
                         src="<?=$category->icon?>"
                         alt="..."
                    />
                    <!-- Текстовый контент -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <?php if (true === $category->isFinal) : ?>
                                <a href="/products/<?= $category->id; ?>"><?= $category->name ?></a>
                            <?php else : ?>
                                <a href="/categories/<?= $category->id; ?>"><?= $category->name ?></a>
                            <?php endif; ?>
                        </h5>
                        <p class="card-text">Описание</p>
                        <a href="#" class="btn btn-primary btn-success mt-auto">В корзину</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>


        <?php endforeach; ?>
    </div>


