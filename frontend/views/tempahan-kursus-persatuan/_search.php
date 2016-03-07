<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TempahanKursusPersatuanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tempahan-kursus-persatuan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tempahan_kursus_persatuan_id') ?>

    <?= $form->field($model, 'kursus_persatuan_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'jenis_tempahan') ?>

    <?= $form->field($model, 'unit_tempahan') ?>

    <?php // echo $form->field($model, 'kos_tempahan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
