<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKemudahanVenueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kemudahan-venue-msn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kemudahan_venue_id') ?>

    <?= $form->field($model, 'nama_venue') ?>

    <?= $form->field($model, 'alamat_1') ?>

    <?= $form->field($model, 'alamat_2') ?>

    <?= $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'no_faks') ?>

    <?php // echo $form->field($model, 'pemilik') ?>

    <?php // echo $form->field($model, 'sewaan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
