<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanEBantuanSenaraiPermohonanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-senarai-permohonan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'senarai_permohonan_id') ?>

    <?= $form->field($model, 'permohonan_e_bantuan_id') ?>

    <?= $form->field($model, 'nama_program') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'jumlah_kelulusan') ?>

    <?php // echo $form->field($model, 'penghantaran_laporan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
