<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Feedback $model */
/** @var ActiveForm $form */
$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">
<h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['style' => 'background-image: url("/images/bg-feedback.jpg"); padding: 2vw']]); ?>

        <?= $form->field($model, 'fio') ?>
        <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
            'mask' => '+7(999)-999-99-99',
        ]) ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= $form->field($model, 'check')->checkbox() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- feedback-index -->
