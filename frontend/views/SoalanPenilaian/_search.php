<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SoalanPenilaianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soalan-penilaian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'soalan_penilaian_id') ?>

    <?= $form->field($model, 'borang_penilaian_id') ?>

    <?= $form->field($model, 'bahagian') ?>

    <?= $form->field($model, 'soalan') ?>

    <?= $form->field($model, 'jawapan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
