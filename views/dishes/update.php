<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Dishes $model */

$this->title = 'Обновить запись Блюдо: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Блюдо', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="dishes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
