<?php
/* @var $productList */
/* @var $pagination */

use yii\helpers\Html;
use yii\bootstrap4\LinkPager;


$this->title = 'Main Page'
?>
    <h1></h1>

<div class="row row-cols-1 row-cols-md-4">
        <?php foreach ($productList as $product): ?>
    <div class="col mb-4">

    <div class="card h-100">
        <!-- Изображение -->

        <img class="card-img-top" src="https://sun9-60.userapi.com/c855032/v855032364/16bf91/ubWDUdv6oQc.jpg" alt="...">
        <!-- Текстовый контент -->
        <div class="card-body">
            <div class="card-title">
                <a href="/product/<?=$product->url; ?>"><?= $product->title ?></a>
            </div>
            <a href="#" class="btn btn-primary">В корзину</a>
        </div>
    </div>
    </div>
<?php endforeach; ?>
</div>



<?= LinkPager::widget(['pagination' => $pagination]) ?>