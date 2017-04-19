<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeralatanPinjaman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-peralatan-pinjaman-form">
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::lapangan_mandatori ?></p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?php $model->isNewRecord ? $model->aktif = 1: $model->aktif = $model->aktif ;  ?>
    <?= $form->field($model, 'aktif')->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>

    

    

    

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <a href="../ref-peralatan-ujian-fisiologi/_form.php"></a>
    <?php ActiveForm::end(); ?>

</div>
