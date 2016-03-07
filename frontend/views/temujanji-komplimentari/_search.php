<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TemujanjiKomplimentariSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temujanji-komplimentari-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'temujanji_komplimentari_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'perkhidmatan') ?>

    <?= $form->field($model, 'tarikh_khidmat') ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <?php // echo $form->field($model, 'status_temujanji') ?>

    <?php // echo $form->field($model, 'catitan_ringkas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
