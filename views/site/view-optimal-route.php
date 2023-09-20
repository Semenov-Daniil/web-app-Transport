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

$this->title = 'Оптимальный маршрут';
$this->params['breadcrumbs'][] = ['label' => 'Форма расчета оптимального маршрута', 'url' => ['form-optimal-route']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'route_number',
                'label' => 'Номер маршрута'
            ],
            [
                'attribute' => 'start',
                'label' => 'Начальный пункт',
                'value' => function($model) {
                    return (Station::findOne($model['start']))->title;
                }
            ],
            [
                'attribute' => 'end',
                'label' => 'Конечный пункт',
                'value' => function($model) {
                    return (Station::findOne($model['end']))->title;
                }
            ],
            [
                'attribute' => 'time',
                'label' => 'Время'
            ],
        ],
    ]); ?>

    <?=Html::a('Экспорт1', ['site/export1', 'title' => 'optimal_route'], ['class' => 'btn btn-primary']);?>
    <?=Html::a('Экспорт2', ['site/export2', 'title' => 'optimal_route'], ['class' => 'btn btn-primary']);?> 
</div>
