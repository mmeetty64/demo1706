<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model{
    public $id;
    public $fio;
    public $login;
    public $email;
    public $passport;
    public $password;
    public $phone;
    public $category_id;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fio', 'login', 'email', 'passport', 'password', 'phone', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['fio', 'login', 'email', 'passport', 'password', 'phone'], 'string', 'max' => 255],
            [['login'], 'unique', 'targetClass' => User::class],
            [['email'], 'unique', 'targetClass' => User::class],
            ['fio', 'match', 'pattern' => '/^[а-яёА-ЯЁ\s]*$/u'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z]*$/i'],
            ['email', 'email'],
            ['passport', 'match', 'pattern' => '/^\d{4}\s\d{6}$/i'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z\d]*$/i'],
            ['password', 'string', 'min' => 6],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/i'],

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'login' => 'Логин',
            'email' => 'email',
            'passport' => 'серия и номер паспорта',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'category_id' => 'Категория граждан',
            'role_id' => 'Role ID',
            'authKey' => 'Auth Key',
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user =new User();

            $user->attributes = $this->attributes;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->authKey = Yii::$app->security->generateRandomString();
            $user->role_id = Role::getRoleId('User');

            if(!$user->save()){
                return Yii::$app->session->setFlash('danger', 'Произошла ошибка, попробуйте позже!');
            }
        }
        return $user ?? false;
    }
}
