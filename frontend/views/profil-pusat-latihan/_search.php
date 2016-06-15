<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfilPusatLatihanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-pusat-latihan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'profil_pusat_latihan_id') ?>

    <?= $form->field($model, 'nama_pusat_latihan') ?>

    <?= $form->field($model, 'alamat_1') ?>

    <?= $form->field($model, 'alamat_2') ?>

    <?= $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'no_faks') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'tarikh_program_bermula') ?>

    <?php // echo $form->field($model, 'tahun_siap_pembinaan') ?>

    <?php // echo $form->field($model, 'kos_project') ?>

    <?php // echo $form->field($model, 'keluasan_venue') ?>

    <?php // echo $form->field($model, 'hakmilik') ?>

    <?php // echo $form->field($model, 'kadar_sewaan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
