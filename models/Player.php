<?php
/**
 * Created by PhpStorm.
 * User: Рома
 * Date: 01.08.2017
 * Time: 20:08
 */

namespace app\models;

use yii\db\ActiveRecord;

class Player extends ActiveRecord
{

    public static function tableName()
    {
        return 'player';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }

}