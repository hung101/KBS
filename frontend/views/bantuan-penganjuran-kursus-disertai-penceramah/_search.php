<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BantuanPenganjuranKursusDisertaiPenceramahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penganjuran-kursus-disertai-penceramah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bantuan_penganjuran_kursus_disertai_penceramah_id') ?>

    <?= $form->field($model, 'bantuan_penganjuran_kursus_id') ?>

    <?= $form->field($model, 'kursus_seminar_bengkel') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'anjuran') ?>

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
