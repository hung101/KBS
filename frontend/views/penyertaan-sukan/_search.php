<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenyertaanSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penyertaan-sukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penyertaan_sukan_id') ?>

    <?= $form->field($model, 'nama_sukan') ?>

    <?= $form->field($model, 'tempat_penginapan') ?>

    <?= $form->field($model, 'tempat_latihan') ?>

    <?= $form->field($model, 'nama_atlet') ?>

    <?php // echo $form->field($model, 'nama_pegawai') ?>

    <?php // echo $form->field($model, 'jawatan_pegawai') ?>

    <?php // echo $form->field($model, 'nama_pengurus_sukan') ?>

    <?php // echo $form->field($model, 'nama_sukarelawan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
