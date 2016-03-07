<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKosKursusPersatuanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-perhimpunan-kem-kos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_perhimpunan_kem_kos_id') ?>

    <?= $form->field($model, 'kursus_persatuan_id') ?>

    <?= $form->field($model, 'kategori_kos') ?>

    <?= $form->field($model, 'anggaran_kos_per_kategori') ?>

    <?= $form->field($model, 'revised_kos_per_kategori') ?>

    <?php // echo $form->field($model, 'approved_kos_per_kategori') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
