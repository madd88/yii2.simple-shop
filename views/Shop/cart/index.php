<?php
/* @var $products */
/* @var $count */
/* @var $amount */

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
                    <td><a href="/product/<?= $idx ?>"><?= $product['name'] ?></a></td>
                    <td><input type="number" data-product-id="<?= $idx ?>" class="cart-product-count" value="<?= $product['count'] ?>"/></td>
                    <td><?= $product['price'] ?></td>
                    <td><button class="btn btn-danger remove-from-cart" data-product-id="<?= $idx; ?>">Удалить</button></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2"><b>ИТОГО</b></td>
                <td><b><?= $count; ?></b></td>
                <td><b><?= $amount; ?></b></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>


