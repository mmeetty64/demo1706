<?php

use app\models\Category;
use app\models\Department;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'value' => fn() => Html::encode($model->id)
            ], 
            [
                'attribute' => 'user_id',
                'value' => fn() => Html::encode(User::getFIO()[$model->user_id])
            ], 
            [
                'attribute' => 'department_id',
                'value' => fn() => Html::encode(Department::getDepartment()[$model->department_id])
            ], 
            [
                'label' => 'category',
                'value' => fn() => Html::encode(Category::getCategory()[User::getCategoryUser()[$model->user_id]])
            ], 
            [
                'attribute' => 'description',
                'value' => fn() => Html::encode($model->description)
            ], 
            [
                'attribute' => 'status_id',
                'value' => fn() => Html::encode(Status::getStatus()[$model->status_id])
            ], 
            [
                'attribute' => 'date',
                'value' => fn() => Html::encode(Yii::$app->formatter->asDate($model->date))
            ], 
            [
                'attribute' => 'created_at',
                'value' => fn() => Html::encode(Yii::$app->formatter->asDate($model->created_at))
            ], 
            
        ],
    ]) ?>

</div>
