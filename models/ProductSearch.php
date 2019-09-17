<?php

namespace app\models;

use const SORT_DESC;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'stock'], 'integer'],
            [['name', 'sub_name', 'article_no', 'main_feature', 'dimension', 'package', 'material', 'location'], 'safe'],
            [['price', 'price_profit'], 'number'],
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
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'price' => $this->price,
            'price_profit' => $this->price_profit,
            'category_id' => $this->category_id,
            'stock' => $this->stock,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sub_name', $this->sub_name])
            ->andFilterWhere(['like', 'article_no', $this->article_no])
            ->andFilterWhere(['like', 'main_feature', $this->main_feature])
            ->andFilterWhere(['like', 'dimension', $this->dimension])
            ->andFilterWhere(['like', 'package', $this->package])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}
