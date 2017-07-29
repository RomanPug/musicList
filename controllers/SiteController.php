<?php

namespace app\controllers;

use app\models\Login;
use yii\web\Controller;
use Yii;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $login_model = new Login();

        return $this->render('index', compact('login_model'));

    }

    public function actionLogin()
    {
        $login_model = new Login();

        return $this->render('login', compact('login_model'));
    }
}
