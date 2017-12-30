<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model1img->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model1img->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model1img->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model1img,
        'attributes' => [
            'id',
            'category_id',
            'brand_id',
            'title',
            'description:ntext',
            'price',
            'quantity',
        ],
    ]) ?>
	
	<h4>Please, upload 6 images of product!</h4>
	
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	<?= $form->field($uploadform, 'files')->fileInput(['multiple' => false]) ?>
	
	<?=Html::submitButton('Upload', ['class' => 'btn btn-info']) ?>
	
	<?php ActiveForm::end(); ?>
	<?php if($dataProviderImg): ?>
	
	<?= GridView::widget([
        'dataProvider' => $dataProviderImg,
        'columns' => [
            'id',
			'product_id',
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column){
                    return Html::img(\common\models\ProductImage::getProductImgUrl($model->id, $model->product_id));
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
				'controller' => 'product-image',
                'template' => '{delete}',
            ],
        ],
    ]);?>
	
    <?php endif;?>

</div>
