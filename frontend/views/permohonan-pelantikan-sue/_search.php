<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPelantikanSueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-pelantikan-sue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_pelantikan_sue_id') ?>

    <?= $form->field($model, 'nama_sue') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'emel') ?>

    <?= $form->field($model, 'jumlah_dipohon') ?>

    <?php // echo $form->field($model, 'nama_persatuan') ?>

    <?php // echo $form->field($model, 'tarikh_mula_khidmat') ?>

    <?php // echo $form->field($model, 'sehingga') ?>

    <?php // echo $form->field($model, 'muatnaik') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'tarikh_dipohon') ?>

    <?php // echo $form->field($model, 'jumlah_diluluskan') ?>

    <?php // echo $form->field($model, 'tarikh_kelulusan_jkb') ?>

    <?php // echo $form->field($model, 'bilangan_jkb') ?>

    <?php // echo $form->field($model, 'tarikh_lantikan') ?>

    <?php // echo $form->field($model, 'tarikh_tamat_lantikan') ?>

    <?php // echo $form->field($model, 'tempoh') ?>

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
