<?php

namespace app\controllers;

use app\models\WG;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
//        var_dump(strcasecmp("foo", 0) );die;
        $wg = new WG();
        echo '<pre>';
        echo "<br>kalessin";
        echo "<br>Эфф: ".$wg->getEff();
        echo "<br>WN8: ".$wg->getWN8();
        $wg->account_id = 17511656;
        echo "<br>______DIESEL______";
        echo "<br>Эфф: ".$wg->getEff();
        echo "<br>WN8: ".$wg->getWN8();
        echo '</pre>';
         die;
        return $this->render('index');
    }
}
