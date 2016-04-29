<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PemberianJusPemulihanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemberian-jus-pemulihan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pemberian_jus_pemulihan_id') ?>

    <?= $form->field($model, 'perkhidmatan_permakanan_id') ?>

    <?= $form->field($model, 'kategori_atlet') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'acara') ?>

    <?php // echo $form->field($model, 'atlet') ?>

    <?php // echo $form->field($model, 'nama_jus') ?>

    <?php // echo $form->field($model, 'jenis_jus') ?>

    <?php // echo $form->field($model, 'kuantiti') ?>

    <?php // echo $form->field($model, 'berat_badan') ?>

    <?php // echo $form->field($model, 'buah') ?>

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
