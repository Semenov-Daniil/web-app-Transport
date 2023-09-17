<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $fio;
    public $email;
    public $phone;
    public $login;
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fio', 'email', 'phone', 'login', 'password', 'password_repeat'], 'required'],
            ['email', 'email'],
            ['login', 'unique', 'targetClass' => Users::class],
            ['fio', 'match', 'pattern' => '/^[а-яА-ЯёЁ\s\-]+$/u'],
            ['phone', 'match', 'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/u'],
            [['fio', 'email', 'phone', 'login', 'password'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 4],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'ФИО',
            'email' => 'E-mail',
            'phone' => 'Номер телефона',
            'login' => 'Логин',
            'password' => 'Пароль',
            'password_repeat' => 'Подтверждение пароля',
        ];
    }

    public function userRegister()
    {
        if ($this->validate()) {
            $user = new Users();
            if ($user->load($this->attributes, '')) {
                $user->password = Yii::$app->security->generatePasswordHash($this->password);
                $user->token = Yii::$app->security->generateRandomString();

                if ($user->save()) {
                    return $user;
                }
            }
        }
        return false;
    }
}
