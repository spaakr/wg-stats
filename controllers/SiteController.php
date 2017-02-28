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
     * @param null $search
     * @return string
     */
    public function actionIndex($search = null)
    {
        $wg = new WG();
        echo '<pre>';
        if ($account_id = $wg->getAccountId($search)) {
            echo "<br>$search";
            echo "<br>Account_id: $account_id";
            echo "<br>Эфф: " . $wg->getEff();
            echo "<br>WN8: " . $wg->getWN8();
        }
        echo '</pre>';
        die;
        return $this->render('index');
    }
}
