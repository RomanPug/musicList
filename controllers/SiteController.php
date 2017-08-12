<?php

namespace app\controllers;

use app\models\Login;
use app\models\Signup;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

class SiteController extends Controller
{

//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['index', 'logout', 'signup'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index', 'signup'],
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['logout'],
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return Yii::$app->response->redirect(['/player']);
        }

        $login_model = new Login();


        if ($login_model->load(Yii::$app->request->post()) && $login_model->login()) {
            return Yii::$app->response->redirect(['/player']);
        }

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

        if (isset($_POST['Signup'])){
            $signup_model->attributes = Yii::$app->request->post('Signup'); // массовая передача всех данных из массива $_POST['Singup'] в $model

            if ($signup_model->validate() && $signup_model->singup()) {

                return $this->goHome();

            }
        }

        return $this->render('signup', compact('signup_model'));
    }
}
