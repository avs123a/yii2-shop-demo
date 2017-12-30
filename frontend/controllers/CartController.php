<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Product;
use common\models\Order;
use common\models\OrderItem;

class CartController extends Controller
{
	
	//adding to cart
	public function actionAdd($productId)
	{
		$color = null;
		$product = Product::findOne($productId);
		$session = Yii::$app->session;
		if($cl = Yii::$app->request->post('selected_color')){
			$color = $cl;
		}else{
			$color = 'black';
		}
		$session["item_$productId"] = [
		    'id_item_cart' => $productId,
			'title' => $product->title,
            'price' => $product->price,
			'color' => $color,
			'quantity' => 1,
            'avquantity' => $product->quantity,	
		];
        
		$session->addFlash('success', 'You added product to your cart');
		return $this->redirect(['//catalog/list']);
		
	}
	
	//show cart
	public function actionList()
	{
		$model = Yii::$app->session;
		
		return $this->render('list',[
		    'model' => $model,
		]);
	}
	
	public function actionUpdateItem($id, $option1)
	{
		$cart = Yii::$app->session;
		$item = $cart["item_$id"];
		switch($option1)
		{
			case 'add': ++$item['quantity'];
			break;
			case 'reduce': --$item['quantity'];
			break;
		}
		$cart["item_$id"] = $item;
		
		return $this->redirect(['cart/list']);
		
	}
	
	//delete item
	public function actionDeleteItem($item_id)
	{
		$cart = Yii::$app->session;
		$cart->remove("item_$item_id");
		
		return $this->redirect(['cart/list']);
	}
	
	//place order
	public function actionOrder()
	{
		$model = new Order();
		
		$cart = Yii::$app->session;
		
		
		if($model->load(Yii::$app->request->post()) && $model->save())
		{
			foreach($cart as $key => $value){
				if($value['id_item_cart']!=null){
				    $item = new OrderItem();
				    $item->order_id = $model->id;
				    $item->product_id = $value['id_item_cart'];
					$item->color = $value['color'];
				    $item->quantity = $value['quantity'];
					
					if($item->save()){
						$cart->remove('item_'.$value['id_item_cart']);
					}
				}
			}
			Yii::$app->session->addFlash('success', 'Thanks for your order. We will contact to you.');
			return $this->redirect(['//catalog/list']);
			
		}
		else
		{
			return $this->render('order', [
			    'model' => $model,
			    'cart' => $cart,
			
			
			]);
			
		}
		
	}
	
	
}