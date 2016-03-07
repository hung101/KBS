<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JurulatihKeluargaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurulatih-keluarga-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jurulatih_keluarga_id') ?>

    <?= $form->field($model, 'jurulatih_id') ?>

    <?= $form->field($model, 'nama_suami_isteri_waris') ?>

    <?= $form->field($model, 'alamat_surat_menyurat_1') ?>

    <?= $form->field($model, 'alamat_surat_menyurat_2') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_3') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_poskod') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
