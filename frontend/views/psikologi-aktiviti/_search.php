<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PsikologiAktivitiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="psikologi-aktiviti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'psikologi_aktiviti_id') ?>

    <?= $form->field($model, 'psikologi_profil_id') ?>

    <?= $form->field($model, 'nama_aktiviti') ?>

    <?= $form->field($model, 'tarikh_mula') ?>

    <?= $form->field($model, 'tarikh_tamat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
