<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UjianSaringanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ujian-saringan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ujian_saringan_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'sekolah') ?>

    <?= $form->field($model, 'alamat_1') ?>

    <?= $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'darjah') ?>

    <?php // echo $form->field($model, 'berat_badan') ?>

    <?php // echo $form->field($model, 'ketinggian') ?>

    <?php // echo $form->field($model, 'tinggi_duduk') ?>

    <?php // echo $form->field($model, 'panjang_depa') ?>

    <?php // echo $form->field($model, 'body_mass_index') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
