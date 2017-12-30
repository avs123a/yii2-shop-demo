<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Order';

if(Yii::$app->user->isGuest){
	$cust_type = 'Guest';
}else{
	$cust_type ='User';
}

?>
<div style="min-height:400px; ">
    <h2>Making an Order</h2>
	<h3>Items info:</h3>
	<div class="row" style="height:20px !important">
	    <div class="col-xs-3"><strong>Title</strong></div>
		<div class="col-xs-3"><strong>Price</strong></div>
		<div class="col-xs-2"><strong>Color</strong></div>
		<div class="col-xs-2"><strong>Quantity</strong></div>
		<div class="col-xs-2"><strong>Item Summary</strong></div>
	</div>
	<?php foreach($cart as $key => $value): ?>
	    <?php if($value['id_item_cart']!=null): ?>
	    <div class="row" style="height:20px !important">
		    <div class="col-xs-3"><?=$value['title'] ?></div>
			<div class="col-xs-3">$<?=$value['price'] ?></div>
			<div class="col-xs-2"><?=$value['color'] ?></div>
			<div class="col-xs-2"><?=$value['quantity'] ?></div>
			<div class="col-xs-2">$<?=$value['price']*$value['quantity'] ?></div>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>

    <?php $form = ActiveForm::begin() ?>
	 <?= $form->field($model, 'customer_type')->hiddenInput(['value' => $cust_type])->label(false) ?>
	 <?= $form->field($model, 'created_at')->hiddenInput(['value' => date('y.m.d')])->label(false) ?>
	<div class="row">
	    <h4>Personal info:</h4>
	    <div class="col-xs-5">
	    <?= $form->field($model, 'surname') ?>
	    </div>
		<div class="col-xs-5">
	    <?= $form->field($model, 'name') ?>
		</div>
	</div>
	<div class="row">
	    <div class="col-xs-5">
		    <h4>Shipping address:</h4>
	        <?= $form->field($model, 'country') ?>
	
	        <?= $form->field($model, 'region') ?>
	
	        <?= $form->field($model, 'city') ?>
	
	       <?= $form->field($model, 'address') ?>
		   
		   <?= $form->field($model, 'zip_code') ?>
	    </div>
		<div class="col-xs-5">
		    <h4>Contact information:</h4>
	        <?= $form->field($model, 'phone') ?>
	
	        <?= $form->field($model, 'email') ?>
		</div>
	</div>
	
	<?= $form->field($model, 'notes')->textArea() ?>
	
	<?= $form->field($model, 'status')->hiddenInput(['value' => 'New'])->label(false) ?>
	
	<?= Html::submitButton('Make Order', ['class' => 'btn btn-default', 'style' => 'color:#cc0000']); ?>
	
	<?php ActiveForm::end() ?>
</div>