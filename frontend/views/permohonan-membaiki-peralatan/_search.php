<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanMembaikiPeralatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-membaiki-peralatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_membaiki_peralatan_id') ?>

    <?= $form->field($model, 'tarikh_permohonan') ?>

    <?= $form->field($model, 'pemohon') ?>

    <?= $form->field($model, 'nama_peralatan') ?>

    <?= $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'nombor_siri') ?>

    <?php // echo $form->field($model, 'tarikh_diterima') ?>

    <?php // echo $form->field($model, 'tarikh_dipulang') ?>

    <?php // echo $form->field($model, 'kerosakan') ?>

    <?php // echo $form->field($model, 'simptom_kerosakan') ?>

    <?php // echo $form->field($model, 'komponen_utama') ?>

    <?php // echo $form->field($model, 'proses_pemeriksaan') ?>

    <?php // echo $form->field($model, 'pembaikan') ?>

    <?php // echo $form->field($model, 'cadangan') ?>

    <?php // echo $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <?php // echo $form->field($model, 'catitan_ringkas') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
