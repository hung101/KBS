<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPeralatanPenggunaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-peralatan-penggunaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_peralatan_penggunaan_id') ?>

    <?= $form->field($model, 'permohonan_peralatan_id') ?>

    <?= $form->field($model, 'nama_peralatan') ?>

    <?= $form->field($model, 'harga_per_unit') ?>

    <?= $form->field($model, 'jumlah_unit') ?>

    <?php // echo $form->field($model, 'bilangan') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'session_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
