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

$this->title = 'Ожидание троллейбуса';
$this->params['breadcrumbs'][] = ['label' => 'Форма ожидания троллейбуса', 'url' => ['form-waiting-trolleybus']];
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
                'attribute' => 'time',
                'label' => 'Время ожидание на остановке'
            ],
            [
                'attribute' => 'alltime',
                'label' => 'Время маршрута'
            ],
            [
                'attribute' => 'stops',
                'label' => 'Количество остановок'
            ],
        ],
    ]); ?>

</div>