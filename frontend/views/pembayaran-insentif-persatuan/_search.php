<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PembayaranInsentifPersatuanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembayaran-insentif-persatuan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pembayaran_insentif_persatuan_id') ?>

    <?= $form->field($model, 'pembayaran_insentif_id') ?>

    <?= $form->field($model, 'persatuan') ?>

    <?= $form->field($model, 'nama_bank') ?>

    <?= $form->field($model, 'no_akaun_bank') ?>

    <?php // echo $form->field($model, 'nilai') ?>

    <?php // echo $form->field($model, 'session_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
