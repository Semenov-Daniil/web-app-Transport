<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Composition $model */

$this->title = 'Создать запись Состав';
$this->params['breadcrumbs'][] = ['label' => 'Состав', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
