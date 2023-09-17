<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Road $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="road-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_station_id')->textInput() ?>

    <?= $form->field($model, 'final_station_id')->textInput() ?>

    <?= $form->field($model, 'distance')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
