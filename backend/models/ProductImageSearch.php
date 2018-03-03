<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductImage;

/**
 * ProductImageSearch represents the model behind the search form about `common\models\ProductImage`.
 */
class ProductImageSearch extends ProductImage
{
	public $created_normal;
	public $updated_normal;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'created_at', 'updated_at'], 'integer'],
			[['created_normal', 'updated_normal'], 'safe'],
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
        $query = ProductImage::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
			    'pageSize' => 6,
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
            'product_id' => $this->product_id,
        ]);
        
	if($this->created_normal)
	        $query->andFilterWhere(['between', 'created_at', strtotime($this->created_normal), strtotime($this->created_normal)+86400]);
	if($this->updated_normal)
		$query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_normal), strtotime($this->updated_normal)+86400]);

        return $dataProvider;
    }
}
