<?php

namespace app\controllers;

use app\models\Player;
use app\models\Playlist;
use app\models\User;
use yii\base\Controller;
use Yii;
use yii\web\UploadedFile;

class PlayerController extends Controller
{

    public function actionIndex()
    {
        $user = User::findIdentity(\Yii::$app->user->id)->attributes;
        $playlist = new Playlist();
        $user_playlist = $playlist->findPlaylistForUser($user['id']);

        $player = new Player();

        if (Yii::$app->request->post('Player')) {
            $player->user_id = $_POST['Player']['user_id'];
            $player->music_name = $_POST['Player']['music_name'];
            $player->playlist_id = $_POST['Player']['playlist_id'];
            $player->music_default_name_file = UploadedFile::getInstance($player, 'music_default_name_file');
            $player->music_default_name = $player->music_default_name_file->baseName;

            $player->save();

            if ($player->music_default_name_file && $player->upload()) {
                return \Yii::$app->response->redirect('/player');
            }

        }

        $find_music = $player->find_music_for_playlist();

        return $this->render('index', compact(
            'user',
            'playlist',
            'user_playlist',
            'player',
            'find_music',
            'r'
        ));
    }
}