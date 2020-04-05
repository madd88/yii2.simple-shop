<?php
/**
 * Контроллер работы с корзиной товаров
 *
 * @package Shop
 * @author Aleksei Nikolaev <madd.niko@gmail.com>
 */

namespace app\controllers\Shop;

use yii\base\Exception;
use yii\web\Controller;
use app\models\Shop\Cart;
use yii\web\Response;

class CartController extends Controller {

    /**
     * Страница товаров в корзине
     *
     * @return mixed
     */
    public function actionIndex() {
        $Cart = new Cart();
        $products = $Cart->getProducts();
        $amount = $Cart->getCartCost();
        $count = $Cart->getCartTotal();
        if (null !== $products) {
            return $this->render('index', ['products' => $products, 'amount' => $amount, 'count' => $count]);
        }
    }

    /**
     * Добавление товара
     *
     * @return string
     */
    public function actionAdd() {
        $Cart = new Cart();
        if (! \Yii::$app->request->isPost) {
            return $this->redirect(['cart/index']);
        }
        /** @var array productId - ID товара, count - количество */
        $data = \Yii::$app->request->post();
        if (! isset($data['productId'])) {
            return $this->redirect(['cart/index']);
        }
        if (! isset($data['count'])) {
            $data['count'] = 1;
        }

        return $Cart->addToCart($data['productId'], $data['count']);
    }

    /**
     * Получение корзины для сокращенного отображения
     *
     * @return array
     */
    public function actionRenderCart(): array {
        $Cart = new Cart();
        $result = [
            'productsTotal' => $Cart->getCartTotal(),
            'cost' => $Cart->getCartCost()
        ];
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }

        return $result;
    }

    /**
     * Удаление товара
     *
     * @return string
     */
    public function actionRemove() {
        $Cart = new Cart();
        $data = \Yii::$app->request->post();

        return $Cart->removeFromCart($data['productId']);
    }

    /**
     * Пересчет стоимости товаров
     *
     * @return bool
     */
    public function actionRecountCart(){
        $Cart = new Cart();
        $data = \Yii::$app->request->get();

        return $Cart->recountCart($data);
    }



}