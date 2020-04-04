<?php

namespace app\models\Shop;

use yii\db\ActiveRecord;

class Products extends Categories
{

    public const PRODUCTS_INFO_URL = 'product';


    public function getProductsList($categoryId = null, $limit = null)
    {
        $list = self::find()
            ->where(['id_category' => $categoryId])
            ->limit($limit)
            ->all();
        return $list;
    }

    public function tvAction(){
        var_dump(234234234);
    }

}