<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanEBantuanSenaraiSemakSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-senarai-semak-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'senarai_semak_id') ?>

    <?= $form->field($model, 'permohonan_e_bantuan_id') ?>

    <?= $form->field($model, 'kertas_kerja_projek_program') ?>

    <?= $form->field($model, 'salinan_sijil_pendaftaran_persatuan_pertubuhan') ?>

    <?= $form->field($model, 'salinan_perlembagaan_persatuan_pertubuhan') ?>

    <?php // echo $form->field($model, 'salinan_buku_bank') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
