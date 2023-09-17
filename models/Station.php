<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "station".
 *
 * @property int $id
 * @property string $title
 *
 * @property Road[] $roads
 * @property Road[] $roads0
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'station';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Roads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoads()
    {
        return $this->hasMany(Road::class, ['start_station_id' => 'id']);
    }

    /**
     * Gets query for [[Roads0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoads0()
    {
        return $this->hasMany(Road::class, ['final_station_id' => 'id']);
    }
}
