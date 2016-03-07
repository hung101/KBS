<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSukanPersatuanpersekutuanduniaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-sukan-persatuanpersekutuandunia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'persatuan_persekutuan_dunia_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'jenis') ?>

    <?= $form->field($model, 'name_persatuan_persekutuan_dunia') ?>

    <?= $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'laman_web') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
