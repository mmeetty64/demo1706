<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $fio
 * @property string $phone
 * @property string $description
 * @property string $photo
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    public $imageFile;
    public $check;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'phone', 'description'], 'required'],
            [['fio', 'phone', 'description', 'photo'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            ['fio', 'match', 'pattern' => '/^[а-яёА-ЯЁ]+\s+[а-яёА-ЯЁ]+\s+[а-яёА-ЯЁ\s]+$/u'],
            ['description', 'match', 'pattern' => '/^[а-яёА-ЯЁ\s\-]*$/u'],
            ['description', 'string', 'min' => 20],
            ['check', 'required', 'requiredValue' => 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'phone' => 'Телефон',
            'description' => 'Отзыв',
            'photo' => 'Фото',
            'imageFile' => 'Фото',
            'check' => 'Согласие на обработку персональных данных'
        ];
    }

    public function upload()
    {
        $fileName = Yii::$app->security->generateRandomString(12) . '_' . time() . '.' . $this->imageFile->extension;
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $fileName);
            $this->photo = $fileName;
            return true;
        } else {
            return false;
        }
    }
}
