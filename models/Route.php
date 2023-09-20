<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "route".
 *
 * @property int $id
 * @property string $route_number
 * @property int $number_of_stop
 * @property int $number_of_car
 * @property int $number_of_passengers
 * @property int $road_id
 * @property int $transport_id
 *
 * @property Road $road
 * @property Transport $transport
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['route_number', 'number_of_stop', 'number_of_car', 'number_of_passengers', 'road_id', 'transport_id'], 'required'],
            [['number_of_stop', 'number_of_car', 'number_of_passengers', 'road_id', 'transport_id'], 'integer'],
            [['route_number'], 'string', 'max' => 255],
            [['road_id'], 'exist', 'skipOnError' => true, 'targetClass' => Road::class, 'targetAttribute' => ['road_id' => 'id']],
            [['transport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transport::class, 'targetAttribute' => ['transport_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_number' => 'Номер маршрута',
            'number_of_stop' => 'Количество остановок',
            'number_of_car' => 'Количество машин',
            'number_of_passengers' => 'Количество пассажиров',
            'road_id' => 'Путь ID',
            'transport_id' => 'Транспорт ID',
        ];
    }

    /**
     * Gets query for [[Road]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoad()
    {
        return $this->hasOne(Road::class, ['id' => 'road_id']);
    }

    /**
     * Gets query for [[Transport]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransport()
    {
        return $this->hasOne(Transport::class, ['id' => 'transport_id']);
    }

    public static function getOptimalRoute($start, $end)
    {
        return static::find()
            ->select([
                'route_number',  '((road.distance)/(transport.avg_speed)) as time', "road.start_station_id as start", "road.final_station_id as end"
            ])
            ->innerJoin('road', 'road.id = route.road_id')
            ->innerJoin('transport', 'transport.id = route.transport_id')
            ->where(['road.start_station_id' => $start])
            ->andWhere(['road.final_station_id' => $end])
            ->orderBy('time')
            ->limit(1)
            ->asArray()
            ->all();
    } 

    public static function getWaitingTrolleybus($number)
    {
        return static::find()
            ->select([
                'route_number', '(road.distance/transport.avg_speed)/number_of_stop as time_in_stops', '(road.distance/transport.avg_speed) as alltime', 'number_of_stop as stops'
            ])
            ->innerJoin('road', 'road.id = route.road_id')
            ->innerJoin('transport', 'transport.id = route.transport_id')
            ->where(['route_number' => $number])
            ->asArray()
            ->all();
    }

    public static function getTramRoutes()
    {
        return static::find()
            ->select([
                'route_number', 'road.distance'
            ])
            ->innerJoin('road', 'road.id = route.road_id')
            ->innerJoin('transport', 'transport.id = route.transport_id')
            ->where(['transport.type' => 'Трамвай'])
            ->orderBy('road.distance DESC')
            ->asArray()
            ->all();
    }

    public static function getProfit()
    {
        return static::find()
            ->select([
                'transport.type', 'SUM(route.number_of_car*number_of_passengers*fare) as profit'
            ])
            ->innerJoin('road', 'road.id = route.road_id')
            ->innerJoin('transport', 'transport.id = route.transport_id')
            ->groupBy('type')
            ->asArray()
            ->all();
    }
}
