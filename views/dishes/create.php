<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Dishes $model */

$this->title = 'Создать запись Блюдо';
$this->params['breadcrumbs'][] = ['label' => 'Блюдо', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dishes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
