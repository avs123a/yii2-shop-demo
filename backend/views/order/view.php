<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model1->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model1->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model1->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model1,
        'attributes' => [
            'id',
			[
                'attribute' => 'customer_type',
				'value' => function($model){
					switch($model['customer_type']){
						case \common\models\Order::GUEST : return 'Guest'; break;
						case \common\models\Order::USER : return 'Registered'; break;
					}
				}
			],
            'surname',
            'name',
            'country',
            'region',
            'city',
            'address:ntext',
            'zip_code',
            'phone',
            'email:email',
            'notes:ntext',
			[
                'attribute' => 'status',
				'value' => function($model){
					switch($model['status']){
						case \common\models\Order::STATUS_NEW : return 'New'; break;
						case \common\models\Order::STATUS_PAID : return 'Paid'; break;
						case \common\models\Order::STATUS_SHIPPING : return 'In shipping'; break;
						case \common\models\Order::STATUS_DONE : return 'Done'; break;
						case \common\models\Order::STATUS_CANCELLED : return 'Cancelled'; break;
					}
				}
			],
			[
			    'format' => ['date', 'dd.MM.Y'],
                'attribute' => 'created_at',
			],
			[
			    'format' => ['date', 'dd.MM.Y'],
                'attribute' => 'updated_at',
			],
        ],
    ]) ?>
	
	<h4>Items to this order</h4>
	
	<?= GridView::widget([
        'dataProvider' => $dataProviderItem,
        'filterModel' => $searchModelItem,
        'columns' => [

            'id',
			[
			    'format' => ['date', 'dd.MM.Y'],
				'attribute' => 'created_at',
				'filter' => DatePicker::widget([
                    'model' => $searchModelItem,
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
                    'model' => $searchModelItem,
                    'attribute' => 'updated_normal',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
			    ]),
            ],
			[
                'attribute' => 'product_id',
				'value' => function($model){
					return \common\models\Product::findOne($model['product_id'])->title;
				}
			],
			'price',
            'color',
            'quantity',

            [
			    'class' => 'yii\grid\ActionColumn',
				'template' => '{delete}',
				'controller' => 'order-item',
			],
        ],
    ]); ?>

</div>
