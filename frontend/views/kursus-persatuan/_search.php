<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KursusPersatuanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kursus-persatuan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kursus_persatuan_id') ?>

    <?= $form->field($model, 'nama_kursus') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'activiti') ?>

    <?= $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'pegawai_terlibat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
