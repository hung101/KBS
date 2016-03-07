<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanSejarahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-perubatan-sejarah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sejarah_perubatan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'jenis') ?>

    <?= $form->field($model, 'jenis_sejarah_perubatan') ?>

    <?= $form->field($model, 'bila') ?>

    <?php // echo $form->field($model, 'mana') ?>

    <?php // echo $form->field($model, 'bagaimana') ?>

    <?php // echo $form->field($model, 'siapa_yang_merawat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
