<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Place;

/**
 * PlaceSearch represents the model behind the search form of `app\models\Place`.
 */
class PlaceSearch extends Place
{
    public $country;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id'], 'integer'],
            [['name', 'country'], 'safe'],
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
        $query = Place::find();

        $query->joinWith(['country']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);

        // Lets do the same with country now
        $dataProvider->sort->attributes['country'] = [
            'asc' => ['countries.name' => SORT_ASC],
            'desc' => ['countries.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'places.id' => $this->id,
            'places.country_id' => $this->country_id,
        ]);


        $query->andFilterWhere(['like', 'places.name', $this->name])
            ->andFilterWhere(['like', 'countries.name', $this->country]);

        $query->orderBy('countries.name');

        return $dataProvider;
    }
}
