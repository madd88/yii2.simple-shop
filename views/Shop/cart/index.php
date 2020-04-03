<?php
/* @var $products */

use yii\helpers\Html;
use yii\bootstrap4\LinkPager;


$this->title = 'Main Page';

?>
    <h1>Корзина</h1>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Артикул</th>
                <th scope="col">Наименование</th>
                <th scope="col">Количество</th>
                <th scope="col">Цена</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $idx => $product) : ?>
                <tr>
                    <th scope="row"><?= $idx ?></th>
                    <td><?= $product['name'] ?></td>
                    <td><input maxlength="3" type="number" value="<?= $product['count'] ?>" /></td>
                    <td><?= $product['price'] ?></td>
                    <td><button class="btn btn-danger remove-from-cart" data-product-id="<?= $idx; ?>">Удалить</button></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


