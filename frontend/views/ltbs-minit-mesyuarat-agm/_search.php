<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratAgmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-minit-mesyuarat-agm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mesyuarat_agm_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'masa') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'jumlah_ahli_yang_hadir') ?>

    <?php // echo $form->field($model, 'jumlah_ahli_yang_layak_mengundi') ?>

    <?php // echo $form->field($model, 'agenda_mesyuarat') ?>

    <?php // echo $form->field($model, 'keputusan_mesyuarat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
