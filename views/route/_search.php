<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RouteSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="route-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'route_number') ?>

    <?= $form->field($model, 'number_of_stop') ?>

    <?= $form->field($model, 'number_of_car') ?>

    <?= $form->field($model, 'number_of_passengers') ?>

    <?php //echo $form->field($model, 'road_id') ?>

    <?php //echo $form->field($model, 'transport_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
