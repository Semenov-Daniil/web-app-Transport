<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Composition;

/**
 * CompositionSearch represents the model behind the search form of `app\models\Composition`.
 */
class CompositionSearch extends Composition
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dishes_id', 'many_portions', 'priority', 'products_id'], 'integer'],
            [['quantity'], 'number'],
            [['pre_processing'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Composition::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dishes_id' => $this->dishes_id,
            'quantity' => $this->quantity,
            'many_portions' => $this->many_portions,
            'priority' => $this->priority,
            'products_id' => $this->products_id,
        ]);

        $query->andFilterWhere(['like', 'pre_processing', $this->pre_processing]);

        return $dataProvider;
    }
}
