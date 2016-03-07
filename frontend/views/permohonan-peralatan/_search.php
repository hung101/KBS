<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPeralatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-peralatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_peralatan_id') ?>

    <?= $form->field($model, 'cawangan') ?>

    <?= $form->field($model, 'negeri') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'program') ?>

    <?php // echo $form->field($model, 'tarikh') ?>

    <?php // echo $form->field($model, 'aktiviti') ?>

    <?php // echo $form->field($model, 'jumlah_peralatan') ?>

    <?php // echo $form->field($model, 'nota_urus_setia') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
