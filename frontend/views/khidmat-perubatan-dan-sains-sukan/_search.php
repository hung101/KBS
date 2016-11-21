<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KhidmatPerubatanDanSainsSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="khidmat-perubatan-dan-sains-sukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'khidmat_perubatan_dan_sains_sukan_id') ?>

    <?= $form->field($model, 'kategori_servis') ?>

    <?= $form->field($model, 'servis') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'tarikh_mula') ?>

    <?php // echo $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'muat_naik') ?>

    <?php // echo $form->field($model, 'kecederaan_jika_ada') ?>

    <?php // echo $form->field($model, 'sukan') ?>

    <?php // echo $form->field($model, 'program') ?>

    <?php // echo $form->field($model, 'mod_latihan') ?>

    <?php // echo $form->field($model, 'sasaran') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
