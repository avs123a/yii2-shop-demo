<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use kartik\file\FileInput;
use dosamigos\datepicker\DatePicker;

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
			[
			    'label' => 'Category',
                'attribute' => 'category_id',
			    'value' => function($model1img){
					return \common\models\Category::findOne($model1img['category_id'])->title;
				}
			],
            [
			    'label' => 'Brand',
                'attribute' => 'brand_id',
			    'value' => function($model1img){
					return \common\models\Brand::findOne($model1img['brand_id'])->title;
				}
			],
            'title',
            'description:ntext',
            'price',
            'quantity',
			[
			    'format' => ['date', 'dd.MM.Y'],
                'attribute' => 'created_at',
			],
			[
			    'format' => ['date', 'dd.MM.Y'],
                'attribute' => 'updated_at',
			]
        ],
    ]) ?>
	
	<h4>Please, upload 6 images of product!</h4>
	
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	<?= $form->field($uploadform, 'files')->widget(FileInput::classname(), [
    'options' => ['multiple' => false],
    'pluginOptions' => ['previewFileType' => 'jpg']
    ])->label('Product image')  ?>
	
	<?php ActiveForm::end(); ?>
	<?php if($dataProviderImg): ?>
	
	<?= GridView::widget([
        'dataProvider' => $dataProviderImg,
		'filterModel' => $searchModelImg,
		'summary' => false,
        'columns' => [
            'id',
			[
			    'format' => ['date', 'dd.MM.Y'],
				'attribute' => 'created_at',
				'filter' => DatePicker::widget([
                    'model' => $searchModelImg,
                    'attribute' => 'created_normal',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
			    ]),
            ],
			[
			    'format' => ['date', 'dd.MM.Y'],
				'attribute' => 'updated_at',
				'filter' => DatePicker::widget([
                    'model' => $searchModelImg,
                    'attribute' => 'updated_normal',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
			    ]),
            ],
            [
			    'label' => 'Image',
                'format' => 'raw',
                'value' => function($model){
                    return Html::img(\common\models\ProductImage::getProductImgUrl($model->id, $model->product_id), ['width' => 200, 'height' => 200]);
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
