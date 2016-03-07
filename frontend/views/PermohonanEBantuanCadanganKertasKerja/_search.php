<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanEBantuanCadanganKertasKerjaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-cadangan-kertas-kerja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_e_bantuan_cadangan_kertas_kerja_id') ?>

    <?= $form->field($model, 'permohonan_e_bantuan_id') ?>

    <?= $form->field($model, 'nama_cadangan_kertas_kerja') ?>

    <?= $form->field($model, 'muat_naik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
