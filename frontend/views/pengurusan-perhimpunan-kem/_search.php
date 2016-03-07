<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPerhimpunanKemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-perhimpunan-kem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_perhimpunan_kem_id') ?>

    <?= $form->field($model, 'nama_ppn') ?>

    <?= $form->field($model, 'pengurus_pn') ?>

    <?= $form->field($model, 'nama_penganjuran') ?>

    <?= $form->field($model, 'kategori_penganjuran') ?>

    <?php // echo $form->field($model, 'sub_kategori_penganjuran') ?>

    <?php // echo $form->field($model, 'tahap_penganjuran') ?>

    <?php // echo $form->field($model, 'negeri') ?>

    <?php // echo $form->field($model, 'kategori_sukan') ?>

    <?php // echo $form->field($model, 'tarikh_penganjuran') ?>

    <?php // echo $form->field($model, 'activiti') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'jumlah_peserta') ?>

    <?php // echo $form->field($model, 'sokongan_pn') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
