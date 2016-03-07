<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanMouMoaAntarabangsaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-mou-moa-antarabangsa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_mou_moa_antarabangsa_id') ?>

    <?= $form->field($model, 'nama_negara_terlibat') ?>

    <?= $form->field($model, 'agensi') ?>

    <?= $form->field($model, 'asas_asas_pertimbangan') ?>

    <?= $form->field($model, 'jangka_waktu_mula') ?>

    <?php // echo $form->field($model, 'jangka_waktu_tamat') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'tajuk_mou_moa') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
