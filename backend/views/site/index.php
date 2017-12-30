<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to admin panel!</h1> 
    </div>

    <div class="body-content">
        <h3>Short Statistics:</h3>
        <div class="row">
            <div class="col-lg-4">
                <h2>Users</h2>

                <p><?=$user_count-1 ?></p>

            </div>
            <div class="col-lg-4">
                <h2>Products</h2>

                <p><?=$product_count ?></p>

            </div>
            <div class="col-lg-4">
                <h2>Orders</h2>

                <p><?=$order_count ?></p>

            </div>
        </div>
		
		<h3>Main Banner settings</h3>

		<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	    <?= $form->field($upload_form, 'files')->fileInput(['multiple' => false]) ?>
	
	    <?=Html::submitButton('Upload Main Banner', ['class' => 'btn btn-info']) ?>
	
	    <?php ActiveForm::end(); ?>
		
		<?=Html::a('Delete Main Banner', ['site/delete-banner'], ['class' => 'btn btn-warning']) ?>
	
	
	    <?=Html::img(\backend\models\SiteSettings::getMainBannerUrl()) ?>
		
    </div>
</div>
