<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AkademiAkkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akademi-akk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'akademi_akk_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'muatnaik_gambar') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'no_passport') ?>

    <?php // echo $form->field($model, 'tarikh_lahir') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'nama_majikan') ?>

    <?php // echo $form->field($model, 'alamat_majikan_1') ?>

    <?php // echo $form->field($model, 'alamat_majikan_2') ?>

    <?php // echo $form->field($model, 'alamat_majikan_3') ?>

    <?php // echo $form->field($model, 'alamat_majikan_negeri') ?>

    <?php // echo $form->field($model, 'alamat_majikan_bandar') ?>

    <?php // echo $form->field($model, 'alamat_majikan_poskod') ?>

    <?php // echo $form->field($model, 'no_telefon_pejabat') ?>

    <?php // echo $form->field($model, 'kategori_pensijilan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
