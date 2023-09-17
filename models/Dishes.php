<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dishes".
 *
 * @property int $id
 * @property string $title
 * @property string $category
 * @property int $weight
 * @property string $recipe
 *
 * @property Composition[] $compositions
 */
class Dishes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'category', 'weight', 'recipe'], 'required'],
            [['weight'], 'integer'],
            [['recipe'], 'string'],
            [['title', 'category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'category' => 'Категория блюда',
            'weight' => 'Вес блюда',
            'recipe' => 'Рецепт',
        ];
    }

    /**
     * Gets query for [[Compositions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompositions()
    {
        return $this->hasMany(Composition::class, ['dishes_id' => 'id']);
    }
}
