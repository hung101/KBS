<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspPenjaminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-penjamin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_penjamin_id') ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'alamat_tetap_1') ?>

    <?php // echo $form->field($model, 'alamat_tetap_2') ?>

    <?php // echo $form->field($model, 'alamat_tetap_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_1') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_2') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_3') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_poskod') ?>

    <?php // echo $form->field($model, 'no_telefon_rumah') ?>

    <?php // echo $form->field($model, 'no_telefon_pejabat') ?>

    <?php // echo $form->field($model, 'no_telefon_bimbit') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'alamat_pejabat_1') ?>

    <?php // echo $form->field($model, 'alamat_pejabat_2') ?>

    <?php // echo $form->field($model, 'alamat_pejabat_3') ?>

    <?php // echo $form->field($model, 'alamat_pejabat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_pejabat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_pejabat_poskod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
