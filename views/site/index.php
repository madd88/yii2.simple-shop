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
                <?= Html::encode("{$product->name}") ?>:
                <?= $product->name ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>