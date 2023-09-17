<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CompositionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="composition-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dishes_id') ?>

    <?php echo $form->field($model, 'products_id') ?>
    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'pre_processing') ?>

    <?= $form->field($model, 'many_portions') ?>

    <?php echo $form->field($model, 'priority') ?>


    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
