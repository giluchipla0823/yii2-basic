<?php

namespace app\models;

use app\components\helpers\DateHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form of `app\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'publisher_id', 'quantity', 'active'], 'integer'],
            [['title', 'description', 'image', 'created_at', 'updated_at', 'deleted_at', 'authorName'], 'safe'],
            [['price'], 'number'],
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
        $query = Book::find();

        // add conditions that should always apply here

        $query->joinWith(['author']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['authorName'] = [
            'asc' => ['authors.name' => SORT_ASC],
            'desc' => ['authors.name' => SORT_DESC]
        ];

        $this->load($params);

        if($this->created_at){
            list($startDate, $endDate) = explode(' - ', $this->created_at);

            $query->andFilterWhere(['>=', self::tableName() . '.created_at', DateHelper::getDateFromUserToSql($startDate)]);
            $query->andFilterWhere(['<=', self::tableName() . '.created_at', DateHelper::getDateFromUserToSql($endDate)]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'publisher_id' => $this->publisher_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'authors.name', $this->authorName]);

        return $dataProvider;
    }
}
