<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;

$this->title = 'Catalog';

$back_img = null;


?>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ window.scrollTo(0,1); } </script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
	
	<div class="banner banner1" style="background-image:url(<?php if($selected_category) echo $selected_category->getCategImgUrl(); else echo \backend\models\SiteSettings::getMainBannerUrl() ?>)">
		<div class="container">
			<h2>Great Offers on <span><?php if($selected_category) echo $selected_category->title; else echo 'Electronics' ?></span> Flat <i>35% Discount</i></h2> 
		</div>
	</div> 
	
	<!-- mobiles -->
	<div class="mobiles">
		<div class="container">
			<div class="w3ls_mobiles_grids">
				<div class="col-md-4 w3ls_mobiles_grid_left">
					<div class="w3ls_mobiles_grid_left_grid">
						<h3>Categories</h3>
						<div class="w3ls_mobiles_grid_left_grid_sub">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
								  <h4 class="panel-title asd">
									<a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i>New Arrivals
									</a>
								  </h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								  <div class="panel-body panel_text">
								  <?=Html::beginForm(['catalog/list'], 'get') ?>
									<ul>
									<?php foreach($categories as $category): ?>
									    <?php if($chld_categ = $category->getCategories()->asArray()->all()): ?>
										    <li><?=$category->title ?></li>
										    <?php foreach($chld_categ as $chldcategory): ?>
											    <li><input type="submit" name="choosed_category" class="btn btn-link" value="<?=$chldcategory['title'] ?>"></li>
											<?php endforeach; ?>
										<?php else: ?>
										  <?if(!$category->parent_id): ?>
										    <li><input type="submit" name="choosed_category" class="btn btn-link" value="<?=$category->title ?>"></li>
										  <?php endif; ?>
										<?php endif; ?>
									<?php endforeach; ?>
									</ul>
								  <?=Html::endForm(); ?>
								  </div>
								</div>
							  </div>
							</div>
						</div>
					</div>
					
					<div class="w3ls_mobiles_grid_left_grid">
						<h3>Price</h3>
						<div class="w3ls_mobiles_grid_left_grid_sub">
							<div class="ecommerce_color ecommerce_size">
							<?=Html::beginForm(['catalog/list'],'get') ?>
								<ul>
									<li><input type="submit" name="less100" class="btn btn-link" value="Below $ 100"></li>
									<li><input type="submit" name="from100to500" class="btn btn-link" value="$ 100-500"></li>
									<li><input type="submit" name="pr1k_10k" class="btn btn-link" value="$ 1k-10k"></li>
									<li><input type="submit" name="pr10k_20k" class="btn btn-link" value="$ 10k-20k"></li>
									<li><input type="submit" name="more20k" class="btn btn-link" value="$ Above 20k"></li>
								</ul>
							<?=Html::endForm(); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 w3ls_mobiles_grid_right">
					
					<div class="clearfix"> </div>

					<div class="w3ls_mobiles_grid_right_grid2">
						<div class="w3ls_mobiles_grid_right_grid2_left">
							<h3>Showing Results: 0-<?=$pagination->totalCount ?></h3>
						</div>
						<div class="w3ls_mobiles_grid_right_grid2_right">
						<?=Html::beginForm(['catalog/list'], 'get') ?>
							<select name="select_item" class="select_item" onChange="form.submit();">
							<?php switch($selected_sort){
								case 'default': echo '
								<option value="default" selected="selected">Default sorting</option>
								<option value="newsort">Sort by newness</option>
								<option value="price_low">Sort by price: low to high</option>
								<option value="price_high">Sort by price: high to low</option>
								' ;
							    break;
								
								case 'newsort': echo '
								<option value="default">Default sorting</option>
								<option value="newsort" selected="selected">Sort by newness</option>
								<option value="price_low">Sort by price: low to high</option>
								<option value="price_high">Sort by price: high to low</option>
								' ;
							    break;
								
								case 'price_low': echo '
								<option value="default">Default sorting</option>
								<option value="newsort">Sort by newness</option>
								<option value="price_low" selected="selected">Sort by price: low to high</option>
								<option value="price_high">Sort by price: high to low</option>
								' ;
							    break;
								
								case 'price_high': echo '
								<option value="default">Default sorting</option>
								<option value="newsort">Sort by newness</option>
								<option value="price_low">Sort by price: low to high</option>
								<option value="price_high"  selected="selected">Sort by price: high to low</option>
								' ;
							    break;
							} ?>
							
							</select>
						<?=Html::endForm(); ?>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="w3ls_mobiles_grid_right_grid3">
					<?php foreach($model as $product): ?>
						<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles">
							<div class="agile_ecommerce_tab_left mobiles_grid">
								<div class="hs-wrapper hs-wrapper2">
								    <?php foreach(\common\models\Product::getProductImagesById($product['id']) as $primage): ?>
									<?=Html::img(\common\models\ProductImage::getProductImgUrl($primage['id'], $primage['product_id']), ['class' => 'img-responsive']) ?>
									<?php endforeach; ?>
									
									<?php Modal::begin([
									    //'header' => '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
									    'toggleButton' => ['label' => '', 'tag' => 'button', 'class' => 'w3_hs_bottom w3_hs_bottom_sub1 glyphicon glyphicon-eye-open'],
									]);?>
									
									<?= $this->render('detail', ['model' => $product]); ?>
									
									<?php Modal::end();?>
								</div>
								<h5><a href="#"><?=$product['title'] ?></a></h5> 
								<div class="simpleCart_shelfItem">
									<p><?php if(\Yii::$app->user->isGuest): ?><i class="item_price">$<?=$product['price'] ?></i><?php else: ?><span>$<?=$product['price'] ?></span> <i class="item_price">$<?=$product['price']*0.8 ?></i><?php endif;?></p>
									<button class="w3ls-cart"><?= Html::a('Add to cart', ['cart/add', 'productId' => $product['id']]) ?></button>
								</div> 
								
							</div>
						</div>
						<?php endforeach; ?>
						<div class="clearfix"> </div>
						
						<?=LinkPager::widget(['pagination' => $pagination]) ?>
						
					</div>
					
						
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>  
	
	
	
	
	<?= $this->registerJs('
		$(window).load(function() {
			$("#flexiselDemo2").flexisel({
				visibleItems:4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:568,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:667,
						visibleItems:2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 3
					}
				}
			});
			
		});
	') ?>
	
