<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Shop\Products;
use app\models\Shop\Categories;
use yii\data\Pagination;

class SiteController extends Controller
{
    public static $a = 1;

    private const CATEGORIES_PREFIX = '/categories/';
    private const PRODUCTS_PREFIX = '/products/';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $list = Products::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $list->count(),
        ]);

        $productList = $list->orderBy('price')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', ['pagination' => $pagination, 'productList' => $productList]);
    }

    /**
     * @param null $parent
     * @param array $menuItems
     * @return array
     */

    public static function getMenu($depth = 1, $currentDepth = 1, $parent = null, $menuItems = []){

        if ($depth < $currentDepth) {
            return null;
        } else {
            $currentDepth++;
        }

        $Categories = Categories::find();
            $count = $Categories
                ->where(['parent_id'=> $parent])
                ->count();

            $list = $Categories
                ->where(['parent_id'=> $parent])
                ->all();

        if (0 === $count) {
            return $menuItems;
        } else {
            foreach ($list as $category) {
                $menuItems[] =
                    [
                        'label' => $category->name,
                        'url'   => $category->isFinal ? self::PRODUCTS_PREFIX . $category->id : self::CATEGORIES_PREFIX . $category->id ,
                        'items' => self::getMenu($depth, $currentDepth, $category->id)
                    ];

            }
        }

        return $menuItems;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'Ку Ку')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionGetFlash($key) {
        return json_encode(['type'=>$key, 'message' =>\Yii::$app->session->getFlash($key)]);
    }
}
