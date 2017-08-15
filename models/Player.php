<?php
/**
 * Created by PhpStorm.
 * User: Рома
 * Date: 01.08.2017
 * Time: 20:08
 */

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Player extends ActiveRecord
{

    public $music_default_name_file;

    public static function tableName()
    {
        return 'player';
    }

    public function attributeLabels()
    {
        return [
            'music_name' => 'Название аудиозаписи',
            'playlist_id' => 'Выберие плейлист',
            'music_default_name_file' => 'Выберите аудиозапись'
        ];
    }

    public function rules()
    {
        return [
            ['music_name', 'required', 'message' => 'Поле не может быть пустым'],
            ['music_name', 'trim'],
            ['music_name', 'string', 'min' => 3, 'tooShort' => 'Название не может быть короче 3 символов'],
            ['music_name', 'string', 'max' => 30, 'tooLong' => 'Название не может быть длинее 15 символов'],
            ['user_id', 'required'],
            ['playlist_id', 'required', 'message' => 'Поле не может быть пустым'],
            [['music_default_name_file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'mp3'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->music_default_name_file->saveAs('uploads/' . $this->fileName() . '/' . $this->music_default_name_file->baseName . '.' . $this->music_default_name_file->extension);
            return true;
        } else {
            return false;
        }
    }

    private function fileName()
    {
        $file = 'uploads/' . $this->playlist_id;

        if (is_dir($file)) {
            return $this->playlist_id;
        } else {
            mkdir($file);
            return $this->playlist_id;
        }

    }

    public function find_music_for_playlist()
    {
        $playlist = Yii::$app->request->get('playlist_id');
        return self::find()->where(['playlist_id' => $playlist])->all();
    }

}