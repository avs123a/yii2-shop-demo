<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Brand */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-view">

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
    ])->label('Brand image')  ?>
	
	<?php ActiveForm::end(); ?>
	
	
	<?=Html::img($model->getLogoUrl(), ['width' => 300, 'height' => 100]) ?>

</div>
