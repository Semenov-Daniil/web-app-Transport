<?php

use app\models\Route;
use app\models\Station;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RouteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Прибыль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'type',
                'label' => 'Транспорт'
            ],
            [
                'attribute' => 'profit',
                'label' => 'Прибыль',
            ],
        ],
    ]); ?>

    <?=Html::a('Экспорт1', ['site/export1', 'title' => 'profit'], ['class' => 'btn btn-primary']);?>
    <?=Html::a('Экспорт2', ['site/export2', 'title' => 'profit'], ['class' => 'btn btn-primary']);?> 
</div>
