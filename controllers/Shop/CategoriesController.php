<?php

/**
 * Контроллер работы с категориями товаров
 *
 * @package Shop
 * @author Aleksei Nikolaev <madd.niko@gmail.com>
 */

namespace app\controllers\Shop;

use yii\base\Exception;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Shop\Categories;

class CategoriesController extends Controller {

    /**
     * Страница с дочерними категориями
     *
     * @param int $id ID категории
     * @return mixed
     */
    public function actionGetChildrenList($id) {
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