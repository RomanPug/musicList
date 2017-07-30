<?php

namespace app\controllers;

use yii\base\Controller;
use Yii;

class PlayerController extends Controller
{

    public function actionIndex()
    {
        if (!Yii::$app->user->identity){
            return Yii::$app->response->redirect(['/']);
        }
        return $this->render('index');
    }

}