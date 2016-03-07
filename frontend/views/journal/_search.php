<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JournalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'journal_id') ?>

    <?= $form->field($model, 'nama_penulis') ?>

    <?= $form->field($model, 'telefon_no') ?>

    <?= $form->field($model, 'emel') ?>

    <?= $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'tarikh_journal') ?>

    <?php // echo $form->field($model, 'bahagian') ?>

    <?php // echo $form->field($model, 'artikel_journal') ?>

    <?php // echo $form->field($model, 'status_journal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
