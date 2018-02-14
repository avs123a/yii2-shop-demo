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
		$session = Yii::$app->session;
		$color = null;
		$product = Product::findOne($productId);
		if($cl = Yii::$app->request->post('selected_color')){
			$color = $cl;
		}else{
			$color = 'black';
		}
	    
		$session->set("item_$productId", $color);
		Yii::$app->cart->put($product, 1);
        
		$session->addFlash('success', 'You added product to your cart');
		return $this->redirect(['//catalog/list']);
		
	}
	
	//show cart
	public function actionList()
	{
		/* @var $cart ShoppingCart */
        $cart = Yii::$app->cart;
		
        $products = $cart->getPositions();
        $total = $cart->getCost();

		return $this->render('list',[
		    'products' => $products,
			'total' => $total,
		]);
	}
	
	public function actionUpdateItem($id, $quantity2)
	{
		$product = Product::findOne($id);
		Yii::$app->cart->update($product, $quantity2);
		
		return $this->redirect(['cart/list']);
		
	}
	
	//delete item
	public function actionDeleteItem($item_id)
	{
		$product = Product::findOne($item_id);
		Yii::$app->cart->remove($product);
		Yii::$app->session->remove("item_$item_id");
		
		return $this->redirect(['cart/list']);
	}
	
	//place order
	public function actionOrder()
	{
		$model = new Order();
		
		$cart = Yii::$app->cart;
		$products = $cart->getPositions();
        $total = $cart->getCost();
		
		if($model->load(Yii::$app->request->post()) && $model->save())
		{
			foreach($products as $product){
				$item = new OrderItem();
				$item->order_id = $model->id;
				$item->product_id = $product->getId();
				$item->price = $product->getPrice();
				$item->color = Yii::$app->session->get('item_'.$product->getId());
				$item->quantity = $product->getQuantity();
					
			    if($item->save()){
					Yii::$app->session->remove('item_'.$product->getId());
				}else{
					Yii::$app->session-addFlash('error', 'Error. Contact us, please.');
				}
			}
			$cart->removeAll();

			Yii::$app->session->addFlash('success', 'Thanks for your order. We will contact to you.');
			return $this->redirect(['//catalog/list']);
			
		}
		else
		{
			return $this->render('order', [
			    'model' => $model,
			    'products' => $products,
				'total' => $total,
			]);
			
		}
		
	}
	
	
}