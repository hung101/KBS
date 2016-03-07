<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KegiatanPengalamanJurulatihAkkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kegiatan-pengalaman-jurulatih-akk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kegiatan_pengalaman_jurulatih_akk_id') ?>

    <?= $form->field($model, 'akademi_akk_id') ?>

    <?= $form->field($model, 'nama_sukan_pertandingan') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'peranan') ?>

    <?php // echo $form->field($model, 'persatuan_sukan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
