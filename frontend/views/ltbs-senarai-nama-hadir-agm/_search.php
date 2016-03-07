<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsSenaraiNamaHadirAgmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-senarai-nama-hadir-agm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'senarai_nama_hadir_id') ?>

    <?= $form->field($model, 'mesyuarat_agm_id') ?>

    <?= $form->field($model, 'nama_penuh') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'jawatan') ?>

    <?php // echo $form->field($model, 'kategori_keahlian') ?>

    <?php // echo $form->field($model, 'kehadiran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
