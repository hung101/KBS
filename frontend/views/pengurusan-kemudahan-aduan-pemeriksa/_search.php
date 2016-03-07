<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKemudahanAduanPemeriksaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kemudahan-aduan-pemeriksa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kemudahan_aduan_id') ?>

    <?= $form->field($model, 'pengurusan_kemudahan_venue_id') ?>

    <?= $form->field($model, 'kategori_aduan') ?>

    <?= $form->field($model, 'venue') ?>

    <?= $form->field($model, 'peralatan') ?>

    <?php // echo $form->field($model, 'tarikh_aduan') ?>

    <?php // echo $form->field($model, 'nama_pengadu') ?>

    <?php // echo $form->field($model, 'kenyataan_aduan') ?>

    <?php // echo $form->field($model, 'tindakan_ulasan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
