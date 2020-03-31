<?php

namespace app\controllers\Shop;

use yii\base\Exception;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Shop\Categories;
use app\models\Shop\Products;

class CategoriesController extends Controller
{

    public function actionGetChildrenList($id)
    {
        $category = Categories::find()
            ->where(['id' => $id])
            ->one();

        if (true === $category->isFinal) {
            throw new Exception("ololo", 0001);
        }

        $Categories = Categories::find()
            ->where(['parent_id' => $category->id])
            ->orderBy('name')
            ->all();


        return $this->render('list', [
            'categoryList' => $Categories,
        ]);
    }

}