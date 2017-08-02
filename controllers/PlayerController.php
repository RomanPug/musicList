<?php

namespace app\controllers;

use yii\base\Controller;

class PlayerController extends Controller
{

    public function actionIndex()
    {

        return $this->render('index');
    }
}