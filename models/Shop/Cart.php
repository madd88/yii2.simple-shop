<?php

namespace app\models\Shop;

use yii\base\Model;
use app\models\Shop\Products;

/**@param $productId */
/**@param $amount */

/**@param $products */
class Cart extends Model {

    /**
     * @param int $productId
     * @param int|null $num
     * @return string
     */
    public function addToCart(int $productId, ?int $num = 1) {
        $count = (int) $num;
        if ($count < 1) {
            \Yii::$app->session->setFlash('danger', 'Неверное количество товара');
            return 'danger';
        } elseif ($count > 10) {
            $count = 10;
        }

        $product = Products::findOne($productId);
        if (null === $product) {
            \Yii::$app->session->setFlash('danger', 'Товар не найден');
            return 'danger';
        }

        $session = \Yii::$app->session;
        if (! $session->isActive) {
            $session->open();
        }
        if (! $session->has('cart')) {
            $session->set('cart', []);
            $cart = [];
        } else {
            $cart = $session->get('cart');
        }

        if (isset($cart['products'][$product->id])) { // такой товар уже есть?
            $count = $cart['products'][$product->id]['count'] + $count;
            if ($count > 100) {
                $count = 100;
            }
            $cart['products'][$product->id]['count'] = $count;
        } else { // такого товара еще нет
            $cart['products'][$product->id]['name'] = $product->name;
            $cart['products'][$product->id]['price'] = $product->price;
            $cart['products'][$product->id]['count'] = $count;
        }
        $amount = 0.0;
        foreach ($cart['products'] as $item) {
            $amount = $amount + $item['price'] * $item['count'];
        }
        $cart['amount'] = $amount;
        $session->set('cart', $cart);
        \Yii::$app->session->setFlash('success', 'Товар Добавлен');
        return 'success';

    }

    public function removeFromCart($productId = null) {
        $cart = \Yii::$app->session->get('cart');
        if (null !== $productId) {
            unset($cart['products'][$productId]);
            $cart['amount'] = $this->calculateCartCost($cart);
            \Yii::$app->session->set('cart', $cart);
            \Yii::$app->session->setFlash('warning', 'Товар удален');
            return 'warning';
        }
    }

    public function getProducts() {
        $cart = \Yii::$app->session->get('cart');
        return $cart['products'];
    }

    /**
     * Возвращает количество единиц товаров в корзине
     * @return int
     */
    public function getCartTotal() {
        $cart = \Yii::$app->session->get('cart');
        $cartTotal = 0;
        if (null !== $cart) {
            foreach ($cart['products'] as $product) {
                $cartTotal += $product['count'];
            }
        }
        return $cartTotal;
    }

    /**
     * Возвращает сумму товаров в корзине
     * @return float
     */
    public function getCartCost() {
        $cart = \Yii::$app->session->get('cart');

        return number_format($cart['amount'], 2, ".", " ");
    }

    /**
     * Пересчет количества товара
     *
     * @param $data
     * @return bool
     */
    public function recountCart($data) {

        $session = \Yii::$app->session;
        $cart = $session['cart'];
        $data['count'] = ($data['count'] < 1) ? 1 : $data['count'];
        $cart['products'][$data['productId']]['count'] = $data['count'];
        $cart['amount'] = $this->calculateCartCost($cart);
        $session->set('cart', $cart);

        return true;
    }

    public function calculateCartCost($cart) {
        $amount = 0;
        foreach ($cart['products'] as $item) {
            $amount = $amount + $item['price'] * $item['count'];
        }

        return $amount;
    }


}