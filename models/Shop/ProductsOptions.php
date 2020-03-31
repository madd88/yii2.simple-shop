<?php

namespace app\models\Shop;

use app\models\Shop\Options;
use yii\db\ActiveRecord;

/** @property int $id */

class ProductsOptions extends ActiveRecord
{

    public static function getProductOptions($productId) {

        return self::find()
            ->where(['product_id'=>$productId])
            ->with('options')
            ->all();
    }


    public function getOptions() {
        return $this->hasOne(Options::class, ['id' => 'option_id']);
    }

}