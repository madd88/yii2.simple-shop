<?php
/**
 * Модель заказов
 *
 * @package Shop
 * @author Aleksei Nikolaev <madd.niko@gmail.com>


 * @property int    $id
 * @property int    $user_id
 * @property string $user_name
 * @property string $user_email
 * @property string $comment
 * @property string $date_created
 * @property string $date_updated
 * @property int    $status
 */

namespace app\models\Shop;

use yii\db\ActiveRecord;

class Orders extends ActiveRecord {

    public function create($data) {

        $Cart = new Cart();

        $this->user_name = $data['order_user_name'];
        $this->user_email = $data['order_user_email'];
        $this->comment = $data['order_comment'];
        $this->cost = $Cart->getCartCost();
        $this->save();

        $cartProducts = $Cart->getProducts();
        foreach ($cartProducts as $cartProduct) {
            $productData = [
                'product_name' => $cartProduct['name'],
                'product_price' => $cartProduct['price'],
                'order_id' => $this->id
            ];
            (new OrdersProducts())->create($productData);
        }

        $Cart->clearCart();

    }

    public function getList() {
        return self::find()
            ->with('ordersProducts')
            ->orderBy(['date_created' => SORT_DESC])
            ->all();
    }

    public function getOrdersProducts()
    {
        return $this->hasMany(OrdersProducts::class, ['order_id' => 'id']);
    }

}