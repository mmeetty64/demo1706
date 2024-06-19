<?php

use app\models\Category;
use app\models\Department;
use app\models\Status;
use app\models\User;
use yii\bootstrap5\Html;
?>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Номер заявки: <?= Html::encode($model->id)?></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">ФИО пользователя: <?= Html::encode(User::getFIO()[$model->user_id])?></h6>
    <p class="card-text">Отдел: <?= Html::encode(Department::getDepartment()[$model->department_id])?></p>
    <p class="card-text">Категория граждан: <?= Html::encode(Category::getCategory()[User::getCategoryUser()[$model->user_id]])?></p>
    <p class="card-text">Описание проблемы: <?= Html::encode($model->description)?></p>
    <p class="card-text">Статус: <?= Html::encode(Status::getStatus()[$model->status_id])?></p>
    <p class="card-text">Дата приема: <?= Html::encode(Yii::$app->formatter->asDatetime($model->date, 'd.m.Y H:i:s'))?></p>
    <p class="card-text">Дата создания: <?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at, 'd.m.Y H:i:s'))?></p>
    <p>
        <?= Html::a('Назад', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= $model->status_id == Status::getStatusId('новое') ? 
        Html::a('в процессе', ['process', 'id' => $model->id], ['class' => 'btn btn-warning'])
        : ''
        ?>
        <?= $model->status_id == Status::getStatusId('новое') || $model->status_id == Status::getStatusId('в процессе') ? 
        Html::a('выполнено', ['apply', 'id' => $model->id], ['class' => 'btn btn-success'])
        .Html::a('отменено', ['deny', 'id' => $model->id], ['class' => 'btn btn-danger'])
        : ''
        ?>
    </p>
  </div>
</div>