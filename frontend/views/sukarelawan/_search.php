<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SukarelawanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sukarelawan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sukarelawan_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'alamat_1') ?>

    <?= $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'tarikh_lahir') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'kebatasan_fizikal') ?>

    <?php // echo $form->field($model, 'menyatakan_jika_ada_kebatasan_fizikal') ?>

    <?php // echo $form->field($model, 'kelulusan_akademi') ?>

    <?php // echo $form->field($model, 'bidang_kepakaran') ?>

    <?php // echo $form->field($model, 'pekerjaan_semasa') ?>

    <?php // echo $form->field($model, 'nama_majikan') ?>

    <?php // echo $form->field($model, 'alamat_majikan_1') ?>

    <?php // echo $form->field($model, 'alamat_majikan_2') ?>

    <?php // echo $form->field($model, 'alamat_majikan_3') ?>

    <?php // echo $form->field($model, 'alamat_majikan_negeri') ?>

    <?php // echo $form->field($model, 'alamat_majikan_bandar') ?>

    <?php // echo $form->field($model, 'alamat_majikan_poskod') ?>

    <?php // echo $form->field($model, 'bidang_diminati') ?>

    <?php // echo $form->field($model, 'waktu_ketika_diperlukan') ?>

    <?php // echo $form->field($model, 'menyatakan_waktu_ketika_diperlukan') ?>

    <?php // echo $form->field($model, 'muatnaik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
