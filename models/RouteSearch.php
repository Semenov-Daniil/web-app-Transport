<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Route;

/**
 * RouteSearch represents the model behind the search form of `app\models\Route`.
 */
class RouteSearch extends Route
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number_of_stop', 'number_of_car', 'number_of_passengers', 'road_id', 'transport_id'], 'integer'],
            [['route_number'], 'safe'],
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
        $query = Route::find();

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
            'number_of_stop' => $this->number_of_stop,
            'number_of_car' => $this->number_of_car,
            'number_of_passengers' => $this->number_of_passengers,
            'road_id' => $this->road_id,
            'transport_id' => $this->transport_id,
        ]);

        $query->andFilterWhere(['like', 'route_number', $this->route_number]);

        return $dataProvider;
    }
}
