<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PembayaranInsentifSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembayaran-insentif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pembayaran_insentif_id') ?>

    <?= $form->field($model, 'kejohanan') ?>

    <?= $form->field($model, 'jenis_insentif') ?>

    <?= $form->field($model, 'pingat') ?>

    <?= $form->field($model, 'kumpulan_temasya_kejohanan') ?>

    <?php // echo $form->field($model, 'rekod_baharu') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <?php // echo $form->field($model, 'tarikh_kelulusan') ?>

    <?php // echo $form->field($model, 'tarikh_pembayaran_insentif') ?>

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
