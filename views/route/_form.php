<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Route $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="route-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'route_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_of_stop')->textInput() ?>

    <?= $form->field($model, 'number_of_car')->textInput() ?>

    <?= $form->field($model, 'number_of_passengers')->textInput() ?>

    <?= $form->field($model, 'road_id')->textInput() ?>

    <?= $form->field($model, 'transport_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
