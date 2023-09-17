<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Road $model */

$this->title = 'Обновить запись Путь: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Путь', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="road-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
