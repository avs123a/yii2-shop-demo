<?php
namespace frontend\controllers;

use Yii;
use common\models\Category;
use common\models\Product;
use common\models\ProductImage;
use common\models\Brand;
use common\models\Order;
use common\models\OrderItem;
use yii\web\Controller;
use yii\data\Pagination;

class CatalogController extends Controller
{
	public function actionList()
	{
	    $prodQuery = Product::find()->where(['not',['quantity'=>0]]);
		
		//$selected_category = 'Electronics';
		$selected_category = null;
		
		//global search
		if($gsearch = Yii::$app->request->get('gsearch')){
		    $prodQuery->andFilterWhere(['like', 'title', $gsearch])->orFilterWhere(['like', 'description', $gsearch]);
		}
		
		//menu
		$categories = Category::find()->all();
		
		if($categ = Yii::$app->request->get('choosed_category')){
		    $category = Category::findOne(['title' => $categ]);
			$prodQuery->andFilterWhere(['category_id' => $category->id]);
		    $selected_category = $category;
		}
		
		
		//filters
		if(Yii::$app->request->get('less100')){
			$prodQuery->andFilterWhere(['<', 'price', 100]);
		}else if(Yii::$app->request->get('from100to500')){
			$prodQuery->andFilterWhere(['between', 'price', 100, 500]);
		}else if(Yii::$app->request->get('pr1k_10k')){
			$prodQuery->andFilterWhere(['between', 'price', 1000, 10000]);
		}else if(Yii::$app->request->get('pr10k_20k')){
			$prodQuery->andFilterWhere(['between', 'price', 10000, 20000]);
		}else if(Yii::$app->request->get('more20k')){
			$prodQuery->andFilterWhere(['>', 'price', 20000]);
		}else{}
		
		
		
		
		
		
		$pagination = new Pagination(['defaultPageSize' => 12, 'totalCount' => $prodQuery->count()]);
		
		//sorting
		$selected_sort = null;
		
		if($sort = Yii::$app->request->get('select_item')){
			switch($sort){
			case 'default': $model = $prodQuery->indexBy('id')->orderBy('id')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
			$selected_sort = 'default';
			break;
			case 'newsort': $model = $prodQuery->indexBy('id')->orderBy('id DESC')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
			$selected_sort = 'newsort';
			break;
			case 'price_low': $model = $prodQuery->indexBy('id')->orderBy('price')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
			$selected_sort = 'price_low';
			break;
			case 'price_high': $model = $prodQuery->indexBy('id')->orderBy('price DESC')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
			$selected_sort = 'price_high';
			break;
			}
		}else{
		    $model = $prodQuery->indexBy('id')->orderBy('id')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
			$selected_sort = 'default';
		}
		
		return $this->render('list', [
		'categories' => $categories,
		'model' => $model,
		'selected_category' => $selected_category,
		'selected_sort' => $selected_sort,
		'pagination' => $pagination,
		]);
	}
	
	
	
	
	
}