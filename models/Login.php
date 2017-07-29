<?php
namespace app\models;

use \yii\base\Model;

class Login extends Model
{

    public $name;
    public $email;
    public $password;

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail:',
            'password' => 'Пароль:'
        ];
    }

    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'message' => 'Поле не может быть пустым'],
            ['email', 'email'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || ($user->validatePassword($this->password))) {
                $this->addError($attribute, 'Логин или пароль введены неверно');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }
}