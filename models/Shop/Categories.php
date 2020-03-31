<?php

namespace app\models\Shop;

use yii\db\ActiveRecord;

/** @property int $id */

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

    public function getId() {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getIsFinal() {
        return 0 === (int)self::find()->where(['parent_id' => $this->id])->count()
            ? true
            : false;
    }
}