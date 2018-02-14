<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Cart';
?>
<div class="cart_view" style="min-height:400px;">
    <div class="cart_list">
	    <div class="row">
	        <div class="col-xs-3"><strong>Title</strong></div>
			<div class="col-xs-2"><strong>Price</strong></div>
			<div class="col-xs-2"><strong>Color</strong></div>
			<div class="col-xs-3"><strong>Quantity</strong></div>
			<div class="col-xs-2"></div>
		</div>
	 
        <?php foreach($products as $product): ?>
	    <div class="row" style="min-height:100px;">
		    <div class="col-xs-3"><?= $product->title ?></div>
			<div class="col-xs-2"><?= "$".$product->getPrice() ?></div>
			<div class="col-xs-2"><?=\Yii::$app->session->get('item_'.$product->getId()) ?></div>
			<div class="col-xs-3"><?php if($product->getQuantity()>1) echo Html::a(' <strong>-</strong> ',['cart/update-item','id'=>$product->getId(),'quantity2'=>$product->getQuantity()-1], ['class' => 'btn btn-default']); echo $product->getQuantity(); if($product->getQuantity()<$product->quantity) echo Html::a(' <strong>+</strong> ',['cart/update-item','id'=>$product->getId(),'quantity2'=>$product->getQuantity()+1], ['class' => 'btn btn-default']); ?> (<?=$product->quantity ?> available)</div>
			<div class="col-xs-2"><?= Html::a('<button type="button" style="background-color:#ff0000;color:#ffffff">x</button>', ['cart/delete-item', 'item_id' => $product->getId()]) ?></div>
		</div>
        <?php endforeach; ?>
		
		<strong>Total: $<?=$total ?></strong>
		<?= Html::a('Order', ['cart/order'], ['class' => 'btn btn-default', 'style' => 'color:#cc0000']); ?>
	</div>
</div>