<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AkkProgramJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akk-program-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'akk_program_jurulatih_id') ?>

    <?= $form->field($model, 'peningkatan_kerjaya_jurulatih_id') ?>

    <?= $form->field($model, 'nama_program') ?>

    <?= $form->field($model, 'tarikh_program') ?>

    <?= $form->field($model, 'tempat_program') ?>

    <?php // echo $form->field($model, 'kod_kursus') ?>

    <?php // echo $form->field($model, 'tahap') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
