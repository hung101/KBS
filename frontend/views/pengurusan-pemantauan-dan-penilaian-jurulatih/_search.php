<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPemantauanDanPenilaianJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-pemantauan-dan-penilaian-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_pemantauan_dan_penilaian_jurulatih_id') ?>

    <?= $form->field($model, 'nama_jurulatih_dinilai') ?>

    <?= $form->field($model, 'nama_sukan') ?>

    <?= $form->field($model, 'nama_acara') ?>

    <?= $form->field($model, 'pusat_latihan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
