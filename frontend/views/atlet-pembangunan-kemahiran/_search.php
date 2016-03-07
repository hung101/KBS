<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKemahiranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-pembangunan-kemahiran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kemahiran_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'jenis_kemahiran') ?>

    <?= $form->field($model, 'nama_kemahiran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
