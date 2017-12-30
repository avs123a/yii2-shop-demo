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
	 
        <?php foreach($model as $key => $value): ?>
	    <div class="row" style="min-height:100px;">
		    <div class="col-xs-3"><?=$value['title'] ?></div>
			<div class="col-xs-2"><?php if($value['id_item_cart']!=null) echo "$" ?><?=$value['price'] ?></div>
			<div class="col-xs-2"><?=$value['color'] ?></div>
			<div class="col-xs-3"><?php if($value['id_item_cart']!=null): ?><?php if($value['quantity']>1) echo Html::a(' <strong>-</strong> ',['cart/update-item','id'=>$value['id_item_cart'],'option1'=>'reduce'], ['class' => 'btn btn-default']); echo $value['quantity']; if($value['quantity']<$value['avquantity']) echo Html::a(' <strong>+</strong> ',['cart/update-item','id'=>$value['id_item_cart'],'option1'=>'add'], ['class' => 'btn btn-default']); ?> (<?=$value['avquantity'] ?> available) <?php endif; ?></div>
			<div class="col-xs-2"><?php if($value['id_item_cart']!=null) echo Html::a('<button type="button" style="background-color:#ff0000;color:#ffffff">x</button>', ['cart/delete-item', 'item_id' => $value['id_item_cart']]) ?></div>
		</div>
        <?php endforeach; ?>
		
		
		<?= Html::a('Order', ['cart/order'], ['class' => 'btn btn-default', 'style' => 'color:#cc0000']); ?>
	</div>
</div>