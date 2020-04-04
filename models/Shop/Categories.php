<?php

namespace app\models\Shop;

use phpDocumentor\Reflection\Types\Self_;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/** @property int $id */

/** @property int $parent_id */
class Categories extends ActiveRecord {

    public const CATEGORIES_LIST_URL = 'categories';
    public const CATEGORIES_PRODUCTS_URL = 'products';


    public function getProductsList($categoryId = null, $limit = null) {
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
        return 0 === (int) self::find()->where(['parent_id' => $this->id])->count()
            ? true
            : false;
    }

    public static function makeTree(Categories $Category) {
        if (null === $Category) {
            return;
        }
        $tree = [];
        while (null !== $Category->parent_id) {
            $tree[] = $Category;
            $Category = self::findOne($Category->parent_id);
        }
        $tree[] = self::getMainParent($Category);

        return $tree;
    }

    /**
     * @param Categories $Category
     * @return Categories|mixed
     */
    public static function getMainParent(Categories $Category) {
        return (null === $Category->parent_id) ? $Category : self::getMainParent(self::findOne($Category->parent_id));
    }
}