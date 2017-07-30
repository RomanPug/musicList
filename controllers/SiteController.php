<?php

namespace app\controllers;

use app\models\Login;
use app\models\Signup;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $login_model = new Login();
        if (!Yii::$app->user->isGuest) {
            return Yii::$app->response->redirect(['/player']);
        }

        if (Yii::$app->request->post('Login')) {
            $login_model->attributes = Yii::$app->request->post('Login');

            if ($login_model->login()) {
                return Yii::$app->response->redirect(['/player']);
            }

        }

//        return $this->render('index', compact('login_model'));

//        if ($login_model->load(Yii::$app->request->post()) && $login_model->login()) {
//            return Yii::$app->response->redirect(['/player']);
//        }
        return $this->render('index', compact('login_model'));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $signup_model = new Signup();
        return $this->render('signup', compact('signup_model'));
    }
}
