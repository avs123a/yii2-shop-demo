<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<!-- banner -->
	<div class="banner" style="background-image:url(<?=\backend\models\SiteSettings::getMainBannerUrl()?>) ">
		<div class="container">
			<h3>Electronic Store, <span>Special Offers</span></h3>
		</div>
	</div>
	<!-- //banner --> 
	
	
	<!-- banner-bottom1 -->
	<div class="banner-bottom1">
		<div class="agileinfo_banner_bottom1_grids">
			<div class="col-md-7 agileinfo_banner_bottom1_grid_left">
				<h3>Grand Opening Event With flat<span>20% <i>Discount</i></span></h3>
				<a href="products.html">Shop Now</a>
			</div>
			<div class="col-md-5 agileinfo_banner_bottom1_grid_right">
				<h4>hot deal</h4>
				<div class="timer_wrap">
					<div id="counter"> </div>
				</div>
				<script src="js/jquery.countdown.js"></script>
				<script src="js/script.js"></script>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //banner-bottom1 --> 
	
	<!-- new-products -->
	<div class="new-products">
		<div class="container">
			<h3>New Products</h3>
			<div class="agileinfo_new_products_grids">
			    <?php foreach($new_products as $new_product): ?>
				<div class="col-md-3 agileinfo_new_products_grid">
					<div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
						<div class="hs-wrapper hs-wrapper1">
							<?php foreach(\common\models\Product::getProductImagesById($new_product['id']) as $imgpr): ?>
							<img src="<?=\common\models\ProductImage::getProductImgUrl($imgpr['id'], $imgpr['product_id'])?>" alt=" " class="img-responsive" />
							<?php endforeach; ?>
								
							<?php Modal::begin([
							//'header' => '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
							'toggleButton' => ['label' => '', 'tag' => 'button', 'class' => 'w3_hs_bottom w3_hs_bottom_sub1 glyphicon glyphicon-eye-open'],
							]);?>
									
							<?= $this->render('//catalog/detail', ['model' => $new_product]); ?>
									
							<?php Modal::end();?>
						</div>
						<h5><a href="#"><?=$new_product['title'] ?></a></h5>
						<div class="simpleCart_shelfItem">
							<p><?php if(\Yii::$app->user->isGuest): ?><i class="item_price">$<?=$new_product['price'] ?></i><?php else: ?><span>$<?=$new_product['price'] ?></span> <i class="item_price">$<?=$new_product['price']*0.8 ?></i><?php endif;?></p>
							<form action="#" method="post">
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="add" value="1"> 
								<input type="hidden" name="w3ls_item" value="Red Laptop"> 
								<input type="hidden" name="amount" value="500.00">   
								<button class="w3ls-cart"><?= Html::a('Add to cart', ['cart/add', 'productId' => $new_product['id']]) ?></button>
							</form>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				
				
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<script>
	function ShowModal(id)
    {
        var modal = document.getElementById(id);
        modal.style.display = "block";
    }
	</script>
	<!-- //new-products -->
	<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
			<h3>Top Brands</h3>
			<div class="row">
			
                <?php foreach($brands as $brand): ?>	
				
						<div class="col-xs-2"><?=Html::img($brand->getLogoUrl(), ['class' => 'img-responsive', 'height' => 200]) ?></div>
					
				<?php endforeach; ?>	

			</div>
			
		</div>
	</div>
	<!-- //top-brands --> 