<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ManualSilibusKurikulumTeknikalKepegawaianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manual-silibus-kurikulum-teknikal-kepegawaian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'manual_silibus_kurikulum_teknikal_kepegawaian_id') ?>

    <?= $form->field($model, 'persatuan_sukan') ?>

    <?= $form->field($model, 'jilid_versi') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'muat_naik') ?>

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
