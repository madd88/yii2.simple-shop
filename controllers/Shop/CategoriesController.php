<?php

namespace app\controllers\Shop;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Shop\Categories;

class CategoriesController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function getMenuList($parent = null, $MenuItems = [])
    {

    }
}