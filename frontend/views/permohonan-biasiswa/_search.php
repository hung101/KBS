<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanBiasiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-biasiswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_biasiswa_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'no_ic') ?>

    <?= $form->field($model, 'umur') ?>

    <?= $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'alamat_rumah_1') ?>

    <?php // echo $form->field($model, 'alamat_rumah_2') ?>

    <?php // echo $form->field($model, 'alamat_rumah_3') ?>

    <?php // echo $form->field($model, 'alamat_rumah_negeri') ?>

    <?php // echo $form->field($model, 'alamat_rumah_bandar') ?>

    <?php // echo $form->field($model, 'alamat_rumah_poskod') ?>

    <?php // echo $form->field($model, 'no_tel_rumah') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'alamat_pengajian_1') ?>

    <?php // echo $form->field($model, 'alamat_pengajian_2') ?>

    <?php // echo $form->field($model, 'alamat_pengajian_3') ?>

    <?php // echo $form->field($model, 'alamat_pengajian_negeri') ?>

    <?php // echo $form->field($model, 'alamat_pengajian_bandar') ?>

    <?php // echo $form->field($model, 'alamat_pengajian_poskod') ?>

    <?php // echo $form->field($model, 'no_tel_pengajian') ?>

    <?php // echo $form->field($model, 'no_fax_pengajian') ?>

    <?php // echo $form->field($model, 'jenis_biasiswa') ?>

    <?php // echo $form->field($model, 'muatnaik') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
