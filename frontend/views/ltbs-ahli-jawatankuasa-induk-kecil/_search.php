<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsAhliJawatankuasaIndukKecilSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-ahli-jawatankuasa-induk-kecil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ahli_jawatan_id') ?>

    <?= $form->field($model, 'jenis_jawatankuasa') ?>

    <?= $form->field($model, 'nama_jawatankuasa') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?= $form->field($model, 'nama_penuh') ?>

    <?php // echo $form->field($model, 'no_kad_pengenalan') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'bangsa') ?>

    <?php // echo $form->field($model, 'umur') ?>

    <?php // echo $form->field($model, 'pekerjaan') ?>

    <?php // echo $form->field($model, 'nama_majikan') ?>

    <?php // echo $form->field($model, 'tarikh_mula_memegang_jawatan') ?>

    <?php // echo $form->field($model, 'pengiktirafan_yang_diterima') ?>

    <?php // echo $form->field($model, 'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
