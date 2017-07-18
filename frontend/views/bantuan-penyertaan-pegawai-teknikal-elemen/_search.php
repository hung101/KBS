<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BantuanPenganjuranKejohananElemenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penyertaan-pegawai-teknikal-elemen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bantuan_penyertaan_pegawai_teknikal_elemen_id') ?>

    <?= $form->field($model, 'bantuan_penganjuran_kejohanan_id') ?>

    <?= $form->field($model, 'elemen_bantuan') ?>

    <?= $form->field($model, 'sub_elemen') ?>

    <?= $form->field($model, 'kadar') ?>

    <?php // echo $form->field($model, 'bilangan') ?>

    <?php // echo $form->field($model, 'hari') ?>

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
