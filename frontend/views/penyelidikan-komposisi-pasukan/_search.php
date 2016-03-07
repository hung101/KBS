<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenyelidikanKomposisiPasukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penyelidikan-komposisi-pasukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penyelidikan_komposisi_pasukan_id') ?>

    <?= $form->field($model, 'permohonana_penyelidikan_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'pasukan') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?php // echo $form->field($model, 'telefon_no') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'institusi_universiti_syarikat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
