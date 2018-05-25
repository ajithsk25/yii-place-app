<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tour;

/**
 * TourSearch represents the model behind the search form of `app\models\Tour`.
 */
class TourSearch extends Tour
{
    // add the public attributes that will be used to store the data to be search
    public $place;
    public $country;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'place_id'], 'integer'],
            [['name', 'place', 'country'], 'safe'],
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
        $query = Tour::find();

        $query->joinWith(['place', 'country']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['place'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['places.name' => SORT_ASC],
            'desc' => ['places.name' => SORT_DESC],
        ];
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
            'tours.id' => $this->id,
            'tours.country_id' => $this->country_id,
            'tours.place_id' => $this->place_id,
        ]);

        $query->andFilterWhere(['like', 'tours.name', $this->name]);

        $query->andFilterWhere(['like', 'places.name', $this->place])
            ->andFilterWhere(['like', 'countries.name', $this->country]);


        $query->orderBy('countries.name');

        return $dataProvider;
    }
}
