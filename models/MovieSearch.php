<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Movie;

/**
 * MovieSearch represents the model behind the search form of `app\models\Movie`.
 */
class MovieSearch extends Movie
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'votesCountNumber'], 'integer'],
            [['title', 'year', 'imgPath', 'miniImgPath'], 'safe'],
            [['rating'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = Movie::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'rating' => $this->rating,
            'votesCountNumber' => $this->votesCountNumber,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'imgPath', $this->imgPath])
            ->andFilterWhere(['like', 'miniImgPath', $this->miniImgPath]);

        return $dataProvider;
    }
}
