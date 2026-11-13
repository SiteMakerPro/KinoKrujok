<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required', 'message' => 'Заполните это поле.'],
            ['email', 'email', 'message' => 'Введите корректный email.'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Этот email уже занят.'],
            [['name', 'email', 'password'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->role = 'user';
            
            return $user->save();
        }
        return false;
    }
}