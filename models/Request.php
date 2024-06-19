<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $user_id
 * @property int $department_id
 * @property string $description
 * @property int $status_id
 * @property string $date
 * @property string $created_at
 *
 * @property Department $department
 * @property Status $status
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    public $date_str;
    public $time_str;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'description', 'date_str', 'time_str'], 'required'],
            [['user_id', 'department_id', 'status_id'], 'integer'],
            [['date', 'created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
            ['time_str', 'getDateNow']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ФИО пользователя',
            'department_id' => 'Отдел',
            'description' => 'Описание проблемы',
            'status_id' => 'Статус',
            'date' => 'Дата приема',
            'created_at' => 'Дата создания',
            'category' => 'Категория граждан',
            'date_str' => 'Дата приема',
            'time_str' => 'Время приема',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getDateNow(){
        $res = self::find()
            ->where(['date' => $this->date_str . ' ' . $this->time_str])
            ->andWhere(['in', 'status_id', [Status::getStatusId('новое'), Status::getStatusId('в процессе')]])
            ->andWhere(['department_id' => $this->department_id])
            ->count();
        if($res){
            Yii::$app->session->setFlash('danger', 'Это время уже занято!');
            $this->addError('time_str', 'Это время уже занято!');
            return false;
        }
        return true;
    }
}
