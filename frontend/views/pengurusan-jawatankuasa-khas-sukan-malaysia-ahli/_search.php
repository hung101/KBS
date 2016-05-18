<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-ahli-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id') ?>

    <?= $form->field($model, 'jenis_keahlian') ?>

    <?= $form->field($model, 'jenis_keahlian_nyatakan') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?php // echo $form->field($model, 'agensi_organisasi') ?>

    <?php // echo $form->field($model, 'agensi_organisasi_nyatakan') ?>

    <?php // echo $form->field($model, 'negeri') ?>

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
