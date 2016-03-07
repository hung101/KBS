<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanEBantuanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_e_bantuan_id') ?>

    <?= $form->field($model, 'nama_pertubuhan_persatuan') ?>

    <?= $form->field($model, 'no_pendaftaran') ?>

    <?= $form->field($model, 'tarikh_didaftarkan') ?>

    <?= $form->field($model, 'pejabat_yang_mendaftarkan') ?>

    <?php // echo $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_1') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_2') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_3') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_poskod') ?>

    <?php // echo $form->field($model, 'no_telefon_pejabat') ?>

    <?php // echo $form->field($model, 'no_telefon_bimbit') ?>

    <?php // echo $form->field($model, 'no_fax') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'bilangan_keahlian') ?>

    <?php // echo $form->field($model, 'bilangan_cawangan_badan_gabungan') ?>

    <?php // echo $form->field($model, 'objektif_pertubuhan') ?>

    <?php // echo $form->field($model, 'aktiviti_dan_kejayaan_yang_dicapai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
