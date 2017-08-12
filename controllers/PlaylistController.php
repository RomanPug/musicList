<?php
/**
 * Created by PhpStorm.
 * User: Рома
 * Date: 05.08.2017
 * Time: 21:09
 */

namespace app\controllers;


use app\models\Playlist;
use yii\base\Controller;


class PlaylistController extends Controller
{

    public function actionAdd()
    {
        $playlist = new Playlist();

        if (isset($_POST['Playlist'])) {
            $playlist->attributes = \Yii::$app->request->post('Playlist');

            if ($playlist->validate() && $playlist->save()) {

                return \Yii::$app->response->redirect('/player');

            }
        }

        return false;
    }
}