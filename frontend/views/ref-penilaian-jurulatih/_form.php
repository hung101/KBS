<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPengajianEBiasiswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-pengajian-ebiasiswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'markah_peratus')->textInput(['maxlength' => 10]) ?>

    <?php $model->isNewRecord ? $model->aktif = 1: $model->aktif = $model->aktif ;  ?>
    <?= $form->field($model, 'aktif')->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>

    

    

    

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>