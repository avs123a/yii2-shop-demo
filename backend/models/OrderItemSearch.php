<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderItem;

/**
 * OrderItemSearch represents the model behind the search form about `common\models\OrderItem`.
 */
class OrderItemSearch extends OrderItem
{
	public $created_normal;
	public $updated_normal;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'product_id', 'quantity', 'created_at', 'updated_at'], 'integer'],
            [['color', 'created_normal', 'updated_normal', 'price'], 'safe'],
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
        $query = OrderItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->asArray(),
			'pagination' => [
			    'pageSize' => 5,
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
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
			'price' => $this->price,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'color', $this->color]);
	    
	if($this->created_normal)
	        $query->andFilterWhere(['between', 'created_at', strtotime($this->created_normal), strtotime($this->created_normal)+86400]);
	if($this->updated_normal)
		$query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_normal), strtotime($this->updated_normal)+86400]);

        return $dataProvider;
    }
}
