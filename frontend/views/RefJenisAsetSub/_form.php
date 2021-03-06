<?php

use app\models\general\GeneralLabel;

use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use app\model\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisAsetSub */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-jenis-aset-sub-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref_jenis_aset_id')->textInput() ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?php $model->isNewRecord ? $model->aktif = 1: $model->aktif = $model->aktif ;  ?>
    <?= $form->field($model, 'aktif')->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>

    

    

    

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
