<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'summary' => false,
        'columns' => [

            'id',
            [
			    'format' => ['date', 'dd.MM.Y'],
				'attribute' => 'created_at',
				'filter' => DatePicker::widget([
                    'model' => $searchModel,
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
                    'model' => $searchModel,
                    'attribute' => 'updated_normal',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
			    ]),
            ],
			[
                'attribute' => 'customer_type',
				'filter' => array(\common\models\Order::GUEST => 'Guest', \common\models\Order::USER => 'Registered'),
				'value' => function($model){
					switch($model['customer_type']){
						case \common\models\Order::GUEST : return 'Guest'; break;
						case \common\models\Order::USER : return 'Registered'; break;
					}
				}
			],
            'surname',
			'name',
            'email:email',
			[
                'attribute' => 'status',
				'filter' => array(\common\models\Order::STATUS_NEW => 'New', \common\models\Order::STATUS_PAID => 'Paid', \common\models\Order::STATUS_SHIPPING => 'In shipping', \common\models\Order::STATUS_DONE => 'Done', \common\models\Order::STATUS_CANCELLED => 'Cancelled'),
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
