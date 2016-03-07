<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorangPenilaianKaunselingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-penilaian-kaunseling-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borang_penilaian_kaunseling_id') ?>

    <?= $form->field($model, 'profil_konsultan_id') ?>

    <?= $form->field($model, 'diagnosis') ?>

    <?= $form->field($model, 'preskripsi') ?>

    <?= $form->field($model, 'cadangan') ?>

    <?php // echo $form->field($model, 'rujukan') ?>

    <?php // echo $form->field($model, 'tindakan_selanjutnya') ?>

    <?php // echo $form->field($model, 'kategori_permasalahan') ?>

    <?php // echo $form->field($model, 'tarikh_temujanji') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
