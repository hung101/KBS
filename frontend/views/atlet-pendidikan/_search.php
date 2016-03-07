<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPendidikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-pendidikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pendidikan_atlet_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'jenis_peringkatan_pendidikan') ?>

    <?= $form->field($model, 'kursus') ?>

    <?= $form->field($model, 'fakulti') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'tahun_mula') ?>

    <?php // echo $form->field($model, 'tahun_tamat') ?>

    <?php // echo $form->field($model, 'pelajar_id_no') ?>

    <?php // echo $form->field($model, 'keputusan_cgpa') ?>

    <?php // echo $form->field($model, 'biasiswa_tajaan') ?>

    <?php // echo $form->field($model, 'jenis_biasiswa') ?>

    <?php // echo $form->field($model, 'jumlah_biasiswa') ?>

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
