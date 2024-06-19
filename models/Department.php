<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $title
 *
 * @property Request[] $requests
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['department_id' => 'id']);
    }

    public static function getDepartment(){
        return (new Query())
        ->select('title')
        ->from('department')
        ->indexBy('id')
        ->column();
    }
}
