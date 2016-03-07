<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PertukaranPengajianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pertukaran-pengajian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pertukaran_pengajian_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'sebab_pemohonan') ?>

    <?= $form->field($model, 'kategori_pengajian') ?>

    <?= $form->field($model, 'nama_pengajian_sekarang') ?>

    <?php // echo $form->field($model, 'nama_pertukaran_pengajian') ?>

    <?php // echo $form->field($model, 'sebab_pertukaran') ?>

    <?php // echo $form->field($model, 'sebab_penangguhan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
