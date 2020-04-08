<?php

/* @var $orders */

$this->title = 'Мои заказы';
?>
<h1><?= $this->title ?></h1>
<div class="row">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Дата заказа</th>
            <th scope="col">Количество товаров</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $idx => $order) : ?>
            <tr>
                <th scope="row"><?= $idx ?></th>
                <td>
                    <a href="/product/<?= $idx ?>"><?= \Yii::$app->formatter->asDatetime($order->date_created, 'dd.MM.YY hh:mm:ss'); ?></a>
                </td>
                <td>3</td>
                <td><?= \Yii::$app->formatter->asDecimal($order->cost, 2); ?></td>
                <td>
                    <button class="btn btn-danger remove-from-cart" data-product-id="<?= $idx; ?>">Удалить</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>



