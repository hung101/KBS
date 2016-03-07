<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AnugerahPelaksaanMajlisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-pelaksaan-majlis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'anugerah_pelaksaan_majlis_id') ?>

    <?= $form->field($model, 'tarikh_majlis_anugerah') ?>

    <?= $form->field($model, 'nama_ahli_jawatan_kuasa') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?= $form->field($model, 'tarikh_pelantikan') ?>

    <?php // echo $form->field($model, 'tempoh') ?>

    <?php // echo $form->field($model, 'nama_tugas') ?>

    <?php // echo $form->field($model, 'status_tugas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
