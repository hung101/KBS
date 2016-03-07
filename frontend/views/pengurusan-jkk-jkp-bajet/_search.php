<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanJkkJkpBajetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-jkk-jkp-bajet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_jkk_jkp_bajet_id') ?>

    <?= $form->field($model, 'pengurusan_jkk_jkp_id') ?>

    <?= $form->field($model, 'kategori_bajet') ?>

    <?= $form->field($model, 'jumlah_bajet') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
