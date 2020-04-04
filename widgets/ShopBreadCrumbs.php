<?php


namespace app\widgets;


use app\models\Shop\Categories;
use app\models\Shop\Products;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

class ShopBreadCrumbs extends Breadcrumbs {

    public function init() {
        parent::init();
        $tree = [];
        $url = explode("/", Url::current());
        if (in_array($url[1], [Categories::CATEGORIES_PRODUCTS_URL, Categories::CATEGORIES_LIST_URL, Products::PRODUCTS_INFO_URL])) {
            $Category = (Products::PRODUCTS_INFO_URL === $url[1])
                ? $Category = Categories::find()->where(['id' => Products::findOne($url[2])->category_id])->one()
                : $Category = Categories::findOne($url[2]);
            $tree = array_reverse(Categories::makeTree($Category));
            foreach ($tree as $k => $Category) {
                $this->links[] = [
                    'label' => $Category->name,
                    'url' => ($k < count($tree)-1) ? '/' . Categories::CATEGORIES_LIST_URL . '/' . $Category->id : null
                ];
            }
            $this->homeLink = [
                'label' => 'Главная',
                'url' => '/'
            ];
        }

    }

    public function run() {
        return parent::run();
    }

}