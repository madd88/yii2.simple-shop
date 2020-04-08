<?php

/**
 * Модель товаров в заказе
 *
 * @package Shop
 * @author Aleksei Nikolaev <madd.niko@gmail.com>
 *
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

class OrdersProducts extends ActiveRecord {

    public function create($data) {
        $this->product_name = $data['product_name'];
        $this->product_price = $data['product_price'];
        $this->order_id = $data['order_id'];
        $this->save();

        return $this;
    }

}