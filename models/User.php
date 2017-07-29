<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'user';
    }

    public function setPassword($pass){
        $this->password = sha1($pass);
    }

    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = NULL){

    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){

    }

    public function validateAuthKey($authKey){

    }
}
