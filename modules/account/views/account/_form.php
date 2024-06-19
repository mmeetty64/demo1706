<?php

use app\models\Department;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */

$time_arr = [
    '08:00:00' => '08:00',
    '09:00:00' => '09:00',
    '10:00:00' => '10:00',
    '11:00:00' => '11:00',
    '12:00:00' => '12:00',
    '13:00:00' => '13:00',
    '14:00:00' => '14:00',
    '15:00:00' => '15:00',
    '16:00:00' => '16:00',
    '17:00:00' => '17:00',
    '18:00:00' => '18:00',
]
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_id')->dropDownList(Department::getDepartment()) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_str')->textInput(['type' => 'date', 'min' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'time_str')->dropDownList($time_arr) ?>


    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
