<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "composition".
 *
 * @property int $id
 * @property int $dishes_id
 * @property float $quantity
 * @property string $pre_processing
 * @property int $many_portions
 * @property int $priority
 * @property int $products_id
 *
 * @property Dishes $dishes
 * @property Products $products
 */
class Composition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'composition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dishes_id', 'quantity', 'pre_processing', 'many_portions', 'priority', 'products_id'], 'required'],
            [['dishes_id', 'many_portions', 'priority', 'products_id'], 'integer'],
            [['quantity'], 'number'],
            [['pre_processing'], 'string', 'max' => 255],
            [['dishes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dishes::class, 'targetAttribute' => ['dishes_id' => 'id']],
            [['products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['products_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dishes_id' => 'Блюдо ID',
            'quantity' => 'Количество',
            'pre_processing' => 'Предварительная обработка',
            'many_portions' => 'На сколько порций',
            'priority' => 'Очередность добавления',
            'products_id' => 'Продукт ID',
        ];
    }

    /**
     * Gets query for [[Dishes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasOne(Dishes::class, ['id' => 'dishes_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::class, ['id' => 'products_id']);
    }
}
