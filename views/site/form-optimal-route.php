<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Форма расчета оптимального маршрута';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kinds-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'register-form']); $form->enableClientValidation = false; ?>

                <?= $form->field($model, 'start_station_id')->dropdownList($listStart)->label('Выбериет начальный пункт: '); ?>
                <?= $form->field($model, 'final_station_id')->dropdownList($listEnd)->label('Выбериет конечный пункт: '); ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Определить', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
