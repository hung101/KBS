<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenyertaanSukanAduanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penyertaan-sukan-aduan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penyertaan_sukan_aduan_id') ?>

    <?= $form->field($model, 'nama_pengadu') ?>

    <?= $form->field($model, 'tarikh_aduan') ?>

    <?= $form->field($model, 'status_aduan') ?>

    <?= $form->field($model, 'aduan_kategori') ?>

    <?php // echo $form->field($model, 'penyataan_aduan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
