<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPenajaansokonganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-penajaansokongan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penajaan_sokongan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama_syarikat') ?>

    <?= $form->field($model, 'alamat') ?>

    <?= $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'peribadi_yang_bertanggungjawab') ?>

    <?php // echo $form->field($model, 'jenis_kontrak') ?>

    <?php // echo $form->field($model, 'nilai_kontrak') ?>

    <?php // echo $form->field($model, 'tahun_permulaan') ?>

    <?php // echo $form->field($model, 'tahun_akhir') ?>

    <?php // echo $form->field($model, 'barang_yang_penyokong') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
