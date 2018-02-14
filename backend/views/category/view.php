<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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
			[
			    'label' => 'Parent category',
                'attribute' => 'parent_id',
			    'value' => function($model){
					return \common\models\Category::findOne($model['parent_id'])->title;
				}
			],
            'title',
            'descrition',
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

	
	
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	<?= $form->field($upload_form, 'files')->widget(FileInput::classname(), [
    'options' => ['multiple' => false],
    'pluginOptions' => ['previewFileType' => 'jpg']
    ])->label('Category image')  ?>
	
	<?php ActiveForm::end(); ?>
	
	
	<?=Html::img($model->getCategImgUrl(), ['width' => 500, 'height' => 400]) ?>
	
	
	
	
	
</div>
