<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form about `common\models\Order`.
 */
class OrderSearch extends Order
{
	public $created_normal;
	public $updated_normal;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'created_at', 'updated_at', 'status'], 'integer'],
            [['created_normal', 'updated_normal', 'customer_type', 'surname', 'name', 'country', 'region', 'city', 'address', 'zip_code', 'phone', 'email', 'notes'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->asArray(),
			'pagination' => [
			    'pageSize' => 15,
			]
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
        ]);

        $query->andFilterWhere(['like', 'customer_type', $this->customer_type])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'status', $this->status]);
	    
	    if($this->created_normal)
	        $query->andFilterWhere(['between', 'created_at', strtotime($this->created_normal), strtotime($this->created_normal)+86400]);
	if($this->updated_normal)
		$query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_normal), strtotime($this->updated_normal)+86400]);

        return $dataProvider;
    }
}
