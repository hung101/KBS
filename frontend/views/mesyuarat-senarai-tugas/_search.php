<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MesyuaratSenaraiTugasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mesyuarat-senarai-tugas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'senarai_tugas_id') ?>

    <?= $form->field($model, 'mesyuarat_id') ?>

    <?= $form->field($model, 'name_tugas') ?>

    <?= $form->field($model, 'tarikh_tamat') ?>

    <?= $form->field($model, 'pegawai') ?>

    <?php // echo $form->field($model, 'atlet_id') ?>

    <?php // echo $form->field($model, 'persatuan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
