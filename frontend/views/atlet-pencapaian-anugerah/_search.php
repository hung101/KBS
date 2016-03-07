<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianAnugerahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-pencapaian-anugerah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'anugerah_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'nama_acara') ?>

    <?= $form->field($model, 'kategori') ?>

    <?php // echo $form->field($model, 'insentif_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
