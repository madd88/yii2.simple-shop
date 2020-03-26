<?php

namespace app\controllers\Shop;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Shop\Categories;
use app\models\Shop\Products;

class ProductsController extends Controller
{
    public function actionIndex($title = '')
    {

    }

    public function actionGetProductsList($categoryTitle = '') {

        $categoryId = Categories::find()
            ->where(['url' => $categoryTitle])
            ->one();

        $query = Products::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->where(['id_categories' => $categoryId->id])->count(),
        ]);

        $products = $query->orderBy('title')
            ->where(['id_categories' => $categoryId->id])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('list', [
            'productList' => $products,
            'pagination' => $pagination,
        ]);
    }

    public function actionGetProductInfo($productUrl = '') {

        $query = Products::find();
        $productInfo = $query
            ->where(['url' => $productUrl])
            ->one();

        return $this->render('info', [
            'productInfo' => $productInfo,
        ]);
    }

    public function getMenuList($parent = null, $MenuItems = [])
    {

    }
}