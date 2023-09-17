<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Transport $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_of_car')->textInput() ?>

    <?= $form->field($model, 'fare')->textInput() ?>

    <?= $form->field($model, 'avg_speed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
