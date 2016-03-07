<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanEBantuanSenaraiAktivitiProjekSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-senarai-aktiviti-projek-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'senarai_aktiviti_projek_id') ?>

    <?= $form->field($model, 'permohonan_e_bantuan_id') ?>

    <?= $form->field($model, 'nama_aktiviti_projek') ?>

    <?= $form->field($model, 'keterangan_ringkas') ?>

    <?= $form->field($model, 'kejayaan_yang_dicapai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
