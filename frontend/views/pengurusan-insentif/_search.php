<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanInsentifSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-insentif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_insentif_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama_insentif') ?>

    <?= $form->field($model, 'kumpulan') ?>

    <?= $form->field($model, 'rekod_baru') ?>

    <?php // echo $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'kelayakan_pingat') ?>

    <?php // echo $form->field($model, 'jumlah_insentif') ?>

    <?php // echo $form->field($model, 'sgar_nama_jurulatih') ?>

    <?php // echo $form->field($model, 'jumlah_sgar') ?>

    <?php // echo $form->field($model, 'sikap_nama_persatuan') ?>

    <?php // echo $form->field($model, 'jumlah_sikap') ?>

    <?php // echo $form->field($model, 'siso_tarikh_kelayakan') ?>

    <?php // echo $form->field($model, 'sisi_tarikh_olimpik') ?>

    <?php // echo $form->field($model, 'jumlah_siso') ?>

    <?php // echo $form->field($model, 'sito_nama_acara_di_olimpik') ?>

    <?php // echo $form->field($model, 'sito_pingat') ?>

    <?php // echo $form->field($model, 'jumlah_sito') ?>

    <?php // echo $form->field($model, 'category_insentif') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
