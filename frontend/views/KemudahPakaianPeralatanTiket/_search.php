<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KemudahPakaianPeralatanTiketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kemudah-pakaian-peralatan-tiket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kemudah_pakaian_peralatan_tiket_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'kategori_permohonan') ?>

    <?= $form->field($model, 'tarikh_diperlukan_pergi') ?>

    <?= $form->field($model, 'tarikh_dijangka_dipulangkan_balik') ?>

    <?php // echo $form->field($model, 'destinasi_daripada') ?>

    <?php // echo $form->field($model, 'destinasi_ke') ?>

    <?php // echo $form->field($model, 'ulasan_permohonan') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
