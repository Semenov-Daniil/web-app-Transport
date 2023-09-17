<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Route $model */

$this->title = 'Обновить запись Маршрут: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Маршрут', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="route-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
