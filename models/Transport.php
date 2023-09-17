<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transport".
 *
 * @property int $id
 * @property string $type
 * @property int $number_of_car
 * @property int $fare
 * @property int $avg_speed
 *
 * @property Route[] $routes
 */
class Transport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'number_of_car', 'fare', 'avg_speed'], 'required'],
            [['number_of_car', 'fare', 'avg_speed'], 'integer'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Название',
            'number_of_car' => 'Количество машин в парке',
            'fare' => 'Стоимость проезда',
            'avg_speed' => 'Средняя скорость',
        ];
    }

    /**
     * Gets query for [[Routes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoutes()
    {
        return $this->hasMany(Route::class, ['transport_id' => 'id']);
    }
}
