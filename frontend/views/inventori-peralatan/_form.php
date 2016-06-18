<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InventoriPeralatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventori-peralatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inventori_id')->textInput() ?>

    <?= $form->field($model, 'nama_peralatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_inv_do')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kuantiti')->textInput() ?>

    <?= $form->field($model, 'harga_per_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'session_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
