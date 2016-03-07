<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JurulatihKesihatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurulatih-kesihatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jurulatih_kesihatan_id') ?>

    <?= $form->field($model, 'jurulatih_id') ?>

    <?= $form->field($model, 'tinggi') ?>

    <?= $form->field($model, 'berat') ?>

    <?= $form->field($model, 'masalah_kesihatan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'pembedahan') ?>

    <?php // echo $form->field($model, 'alahan') ?>

    <?php // echo $form->field($model, 'sejarah_perubatan') ?>

    <?php // echo $form->field($model, 'kecacatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
