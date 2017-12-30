<?php
use yii\helpers\Html;
?>
<section style="min-height:500px">
	<div class="modal-body">
		<div class="col-md-5 modal_body_left">
			<?php foreach(\common\models\Product::getProductImagesById($model['id']) as $primage): ?>
			<?=Html::img(\common\models\ProductImage::getProductImgUrl($primage['id'], $primage['product_id']), ['class' => 'img-responsive', 'height' => 350]) ?>
			<?php endforeach; ?>
		</div>
	  <div class="col-md-7 modal_body_right">
		    <h4><?=$model['title'] ?></h4>
			<p><?=$model['description'] ?></p>
	    
		
		<h5>Color</h5>
		<?= Html::beginForm(['cart/add', 'productId' => $model['id']], 'post') ?>
		    <div class="color-quality">
			  <ul>					       
      			<li><a href="#"><span></span></a></li>
				<li><a href="#" class="brown"><span></span></a></li>
				<li><a href="#" class="purple"><span></span></a></li>
				<li><a href="#" class="gray"><span></span></a></li>
			  </ul>
			  <ul>
			    <li><input type="radio" name="selected_color" value="red"  /></li>
				<li><input type="radio" name="selected_color" value="blue" /></li>
				<li><input type="radio" name="selected_color" value="brown" /></li>
				<li><input type="radio" name="selected_color" value="purple" /></li>
			  </ul>
		    </div>
		<div class="simpleCart_shelfItem">
			<p><?php if(\Yii::$app->user->isGuest): ?><i class="item_price">$<?=$model['price'] ?></i><?php else: ?><span>$<?=$model['price'] ?></span> <i class="item_price">$<?=$model['price']*0.8 ?></i><?php endif;?></p>
			<button type="submit" name="add_btn" class="w3ls-cart">Add To Cart</button>
		</div>
		<?= Html::endForm(); ?>
	  </div>
		<div class="clearfix"> </div>
	</div>
</section>