<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KelayakanAkademiAkkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelayakan-akademi-akk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kelayakan_akademi_akk_id') ?>

    <?= $form->field($model, 'akademi_akk_id') ?>

    <?= $form->field($model, 'nama_peperiksaan') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'keputusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
