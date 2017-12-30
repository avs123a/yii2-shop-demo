<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($model, 'updated_at')->hiddenInput(['value' => date('y.m.d')])->label(false) ?>


    <?= $form->field($model, 'status')->dropDownList(['Cancelled' => 'Cancelled', 'Paid' => 'Paid', 'In shipping' => 'In shipping', 'Done' => 'Done']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
