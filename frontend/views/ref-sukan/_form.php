<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefSukan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-sukan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref_kategori_sukan_id')->textInput() ?>

    <?= $form->field($model, 'aktif')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
