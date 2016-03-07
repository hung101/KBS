<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPestasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-pestasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penilaian_pestasi_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tahap_sihat') ?>

    <?= $form->field($model, 'pencapaian_sukan_dalam_tahun_yang_dinilai') ?>

    <?= $form->field($model, 'kecederaan_jika_ada') ?>

    <?php // echo $form->field($model, 'laporan_kesihatan') ?>

    <?php // echo $form->field($model, 'elaun_yang_diterima') ?>

    <?php // echo $form->field($model, 'skim_hadiah_kemenangan_sukan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
