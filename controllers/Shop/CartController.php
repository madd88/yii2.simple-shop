<?php

namespace app\controllers\Shop;

use yii\base\Exception;
use yii\web\Controller;
use app\models\Shop\Products;
use app\models\Shop\Cart;
use yii\web\Response;

class CartController extends Controller {

    public function actionIndex() {
        $Cart = new Cart();
        $products = $Cart->getProducts();
        $amount = $Cart->getCartCost();
        $count = $Cart->getCartTotal();
        if (null !== $products) {
            return $this->render('index', ['products' => $products, 'amount' => $amount, 'count' => $count]);
        }
    }

    public function actionAdd() {
        $Cart = new Cart();
        if (! \Yii::$app->request->isPost) {
            return $this->redirect(['cart/index']);
        }

        $data = \Yii::$app->request->post();
        if (! isset($data['productId'])) {
            return $this->redirect(['cart/index']);
        }
        if (! isset($data['count'])) {
            $data['count'] = 1;
        }

        return $Cart->addToCart($data['productId'], $data['count']);
    }

    public function actionRenderCart() {
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

    public function actionRemove() {
        $Cart = new Cart();
        $data = \Yii::$app->request->post();
        return $Cart->removeFromCart($data['productId']);
    }

    public function actionRecountCart(){
        $Cart = new Cart();
        $data = \Yii::$app->request->get();
        return $Cart->recountCart($data);
    }



}