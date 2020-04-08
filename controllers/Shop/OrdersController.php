<?php
/**
 * Контроллер работы с заказами
 *
 * @package Shop
 * @author Aleksei Nikolaev <madd.niko@gmail.com>
 */

namespace app\controllers\Shop;

use app\models\Shop\Orders;
use yii\web\Controller;
use yii\helpers\Url;

class OrdersController  extends Controller {

    public function actionIndex() {
        $Orders = (new Orders())->getList();
        return $this->render('index', ['orders' => $Orders]);
    }

    public function actionCreate() {
        if(! \Yii::$app->request->isPost) {
            return;
        }
        (new Orders())->create(\Yii::$app->request->post());

        $this->redirect(Url::to(['index']));

    }

}