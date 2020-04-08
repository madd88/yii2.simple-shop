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
                <td><input type="number" data-product-id="<?= $idx ?>" class="cart-product-count"
                           value="<?= $product['count'] ?>"/></td>
                <td><?= $product['price'] ?></td>
                <td>
                    <button class="btn btn-danger remove-from-cart" data-product-id="<?= $idx; ?>">Удалить</button>
                </td>
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

<p>

    <button class="btn btn-primary btn-info" type="button" data-toggle="collapse" data-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample">
        Оформить заказ
    </button>
</p>
<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <form action="/orders/create" method="post">
            <input type="hidden" name="_csrf" value="<?=\Yii::$app->request->getCsrfToken()?>" />
            <div class="form-group">
                <label for="order_user_name">Ваше имя</label>
                <input type="text" class="form-control" id="order_user_name" name="order_user_name" aria-describedby="">
            </div>
            <div class="form-group">
                <label for="order_email">Email</label>
                <input type="email" class="form-control" id="order_email" name="order_user_email"  aria-describedby="">
            </div>
            <div class="form-group">
                <label for="order_comment">Комментарий к заказу</label>
                <textarea class="form-control" id="order_comment" rows="3" name="order_comment" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-success">Отправить</button>
        </form>
    </div>
</div>


