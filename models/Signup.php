<?php
/**
 * Created by PhpStorm.
 * User: Рома
 * Date: 29.07.2017
 * Time: 22:08
 */

namespace app\models;


use yii\base\Model;

class Signup extends Model
{

    public $name;
    public $email;
    public $password;

    public function attributeLabels()
    {
        return [
            'name' => 'Имя:',
            'email' => 'E-mail:',
            'password' => 'Пароль:',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required', 'message' => 'Поле не может быть пустым'],
            ['email', 'email'],
//            ['email', 'unique'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль не может быть короче 6 символов'],
            ['password', 'string', 'max' => 15, 'tooLong' => 'Пароль не может быть длинее 15 символов'],
        ];
    }

    public function singup(){
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = $user->setPassword($this->password);
        return $user->save();
    }
}