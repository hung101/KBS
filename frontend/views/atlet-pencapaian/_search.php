<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AtletPencapaianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-pencapaian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pencapaian_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama_kejohanan_temasya') ?>

    <?= $form->field($model, 'peringkat_kejohanan') ?>

    <?= $form->field($model, 'tarikh_mula_kejohanan') ?>

    <?php // echo $form->field($model, 'tarikh_tamat_kejohanan') ?>

    <?php // echo $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'nama_acara') ?>

    <?php // echo $form->field($model, 'lokasi_kejohanan') ?>

    <?php // echo $form->field($model, 'insentif_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
