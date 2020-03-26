<?php

namespace app\models\Shop;

use yii\db\ActiveRecord;

class Categories extends ActiveRecord
{
    public function getProductsList($categoryId = null, $limit = null)
    {
        $list = self::find()
            ->where(['id_category' => $categoryId])
            ->limit($limit)
            ->all();
        return $list;
    }
}