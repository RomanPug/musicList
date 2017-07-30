<?php
namespace app\models;

use \yii\base\Model;
use Yii;

class Login extends Model
{

    public $email;
    public $password;
    public $rememberMe = true;

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail:',
            'password' => 'Пароль:',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'message' => 'Поле не может быть пустым'],
            ['email', 'email', 'message' => 'Некорректный E-mail'],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || $user->validatePassword($this->password)) {
                $this->addError($attribute, 'E-mail или пароль введены неверно');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }
}