<?php
/* @var $productList */
/* @var $pagination */

use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = 'Main Page'
?>
    <h1>Countries</h1>
    <ul>
        <?php foreach ($productList as $product): ?>
            <li>
                <?= Html::encode("{$product->title} ({$product->title})") ?>:
                <?= $product->title ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>