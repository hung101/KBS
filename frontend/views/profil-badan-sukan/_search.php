<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilBadanSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-badan-sukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'profil_badan_sukan') ?>

    <?= $form->field($model, 'nama_badan_sukan') ?>

    <?= $form->field($model, 'nama_badan_sukan_sebelum_ini') ?>

    <?= $form->field($model, 'no_pendaftaran_sijil_pendaftaran') ?>

    <?= $form->field($model, 'tarikh_lulus_pendaftaran') ?>

    <?php // echo $form->field($model, 'jenis_sukan') ?>

    <?php // echo $form->field($model, 'alamat_tetap_badan_sukan') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_badan_sukan') ?>

    <?php // echo $form->field($model, 'no_telefon_pejabat') ?>

    <?php // echo $form->field($model, 'no_faks_pejabat') ?>

    <?php // echo $form->field($model, 'emel_badan_sukan') ?>

    <?php // echo $form->field($model, 'pengiktirafan_yang_pernah_diterima_badan_sukan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
