<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKemudahanSediaAdaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kemudahan-sedia-ada-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kemudahan_sedia_ada_id') ?>

    <?= $form->field($model, 'pengurusan_kemudahan_venue_id') ?>

    <?= $form->field($model, 'keluasan_padang') ?>

    <?= $form->field($model, 'jumlah_kapasiti') ?>

    <?= $form->field($model, 'bilangan_kekerapan_penyenggaran') ?>

    <?php // echo $form->field($model, 'kekerapan_penggunaan') ?>

    <?php // echo $form->field($model, 'kekerapan_kerosakan_berlaku') ?>

    <?php // echo $form->field($model, 'cost_pembaikian') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
