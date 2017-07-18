<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPemantauanDanPenilaianJurulatihKetuaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laporan-pemantauan-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'laporan_pemantauan_jurulatih_id') ?>

    <?= $form->field($model, 'jurulatih_id') ?>

    <?= $form->field($model, 'sukan_id') ?>

    <?= $form->field($model, 'program_id') ?>

    <?= $form->field($model, 'pusat_latihan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
