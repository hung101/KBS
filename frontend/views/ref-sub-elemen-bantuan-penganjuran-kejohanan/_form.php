<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubElemenBantuanPenganjuranKejohanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-sub-elemen-bantuan-penganjuran-kejohanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref_sub_elemen_bantuan_penganjuran_kejohanan_id')->textInput() ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aktif')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
