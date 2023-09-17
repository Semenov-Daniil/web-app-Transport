<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "road".
 *
 * @property int $id
 * @property int $start_station_id
 * @property int $final_station_id
 * @property int $distance
 *
 * @property Station $finalStation
 * @property Route[] $routes
 * @property Station $startStation
 */
class Road extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'road';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_station_id', 'final_station_id', 'distance'], 'required'],
            [['start_station_id', 'final_station_id', 'distance'], 'integer'],
            [['start_station_id'], 'exist', 'skipOnError' => true, 'targetClass' => Station::class, 'targetAttribute' => ['start_station_id' => 'id']],
            [['final_station_id'], 'exist', 'skipOnError' => true, 'targetClass' => Station::class, 'targetAttribute' => ['final_station_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_station_id' => 'Начальный пункт',
            'final_station_id' => 'Конечный пункт',
            'distance' => 'Расстояние',
        ];
    }

    /**
     * Gets query for [[FinalStation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFinalStation()
    {
        return $this->hasOne(Station::class, ['id' => 'final_station_id']);
    }

    /**
     * Gets query for [[Routes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoutes()
    {
        return $this->hasMany(Route::class, ['road_id' => 'id']);
    }

    /**
     * Gets query for [[StartStation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStartStation()
    {
        return $this->hasOne(Station::class, ['id' => 'start_station_id']);
    }
}
