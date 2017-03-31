<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-akademik-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'maklumat_akademik_id') ?>

    <?= $form->field($model, 'atlet') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'program') ?>

    <?= $form->field($model, 'no_matrik') ?>

    <?php // echo $form->field($model, 'fakulti') ?>

    <?php // echo $form->field($model, 'atlet_no_tel') ?>

    <?php // echo $form->field($model, 'atlet_hp_no') ?>

    <?php // echo $form->field($model, 'penasihat_akademik') ?>

    <?php // echo $form->field($model, 'penasihat_no_tel') ?>

    <?php // echo $form->field($model, 'penasihat_hp_no') ?>

    <?php // echo $form->field($model, 'semester') ?>

    <?php // echo $form->field($model, 'jumlah_semester') ?>

    <?php // echo $form->field($model, 'jumlah_tahun') ?>

    <?php // echo $form->field($model, 'tahun_kemasukan') ?>

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
