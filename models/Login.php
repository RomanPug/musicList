<?php

namespace app\models;

use \yii\base\Model;
use Yii;

class Login extends Model
{

    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;

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

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный логин или пароль');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
        
            if ($this->rememberMe) {
                $u = $this->getUser();
                $u->generateAuthKey();
                $u->save();
            }

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUseremail($this->email);
        }

        return $this->_user;
    }
}