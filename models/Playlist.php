<?php
/**
 * Created by PhpStorm.
 * User: Рома
 * Date: 05.08.2017
 * Time: 20:13
 */

namespace app\models;


use yii\db\ActiveRecord;

class Playlist extends ActiveRecord
{

    public static function tableName()
    {
        return 'playlist';
    }

    public function attributeLabels()
    {
        return [
            'playlist_name' => 'Название плейлиста',
        ];
    }

    public function rules()
    {
        return [
            ['playlist_name', 'required', 'message' => 'Поле не может быть пустым'],
            ['playlist_name', 'trim'],
            ['playlist_name', 'string', 'min' => 3, 'tooShort' => 'Название не может быть короче 3 символов'],
            ['playlist_name', 'string', 'max' => 15, 'tooLong' => 'Название не может быть длинее 15 символов'],
            ['user_id', 'required'],
        ];
    }

    public function findPlaylistForUser($user_id)
    {
        return self::find()->where(['user_id' => $user_id])->asArray()->all();
    }



}