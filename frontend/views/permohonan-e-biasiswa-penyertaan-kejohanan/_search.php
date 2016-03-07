<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanEBiasiswaPenyertaanKejohananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebiasiswa-penyertaan-kejohanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penyertaan_kejohanan_id') ?>

    <?= $form->field($model, 'permohonan_e_biasiswa_id') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'anjuran') ?>

    <?php // echo $form->field($model, 'kejohanan_mewakili') ?>

    <?php // echo $form->field($model, 'acara') ?>

    <?php // echo $form->field($model, 'nama_kejohanan') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'pencapaian') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
