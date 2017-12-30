<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'customer_type',
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
            'status',
        ],
    ]) ?>
	
	<h4>Items to this order</h4>
	
	<?= GridView::widget([
        'dataProvider' => $dataProviderItem,
        'filterModel' => $searchModelItem,
        'columns' => [

            'id',
            'product.title',
			'product.price',
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
