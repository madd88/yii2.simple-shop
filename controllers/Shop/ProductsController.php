<?php

namespace app\controllers\Shop;

use app\models\Shop\ProductsOptions;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Shop\Categories;
use app\models\Shop\Products;

class ProductsController extends Controller
{
    public function actionIndex($title = '')
    {

    }

    public function actionGetProductsList($categoryId) {

        $query = Products::find();

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->where(['category_id' => $categoryId])->count(),
        ]);

        $productsCount = $query
            ->where(['category_id' => $categoryId])
            ->count();


        if (0 === (int) $productsCount) {
            $message = 'Товары не найдены';
        } else {
            $message = '';
        }

        $products = $query->orderBy('price')
            ->where(['category_id' => $categoryId])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('list', [
            'productList' => $products,
            'pagination' => $pagination,
            'message' => $message
        ]);
    }

    public function actionGetProductInfo($productId = '') {

        $query = Products::find();
        $productInfo = $query
            ->where(['id' => $productId])
            ->one();

        $Product_Options = ProductsOptions::getProductOptions($productId);

        return $this->render('info', [
            'productInfo' => $productInfo,
            'productOptions' => $Product_Options
        ]);
    }

    public function getMenuList($parent = null, $MenuItems = [])
    {

    }
}