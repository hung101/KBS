<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPenilaianKategoriJurulatihKetuaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-penilaian-kategori-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_penilaian_kategori_jurulatih_id') ?>

    <?= $form->field($model, 'pengurusan_pemantauan_dan_penilaian_jurulatih_id') ?>

    <?= $form->field($model, 'penilaian_kategori') ?>

    <?= $form->field($model, 'penilaian_sub_kategori') ?>

    <?= $form->field($model, 'markah_penilaian') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
