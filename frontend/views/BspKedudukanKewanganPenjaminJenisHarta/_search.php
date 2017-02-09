<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspKedudukanKewanganPenjaminJenisHartaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_kedudukan_kewangan_penjamin_jenis_harta_id') ?>

    <?= $form->field($model, 'bsp_kedudukan_kewangan_penjamin_id') ?>

    <?= $form->field($model, 'jenis_harta') ?>

    <?= $form->field($model, 'jumlah_ekar_kaki_persegi') ?>

    <?= $form->field($model, 'nilai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
