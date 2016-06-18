<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\InventoriSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventori-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'inventori_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'program') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'no_co') ?>

    <?php // echo $form->field($model, 'alamat_pembekal_1') ?>

    <?php // echo $form->field($model, 'alamat_pembekal_2') ?>

    <?php // echo $form->field($model, 'alamat_pembekal_3') ?>

    <?php // echo $form->field($model, 'alamat_pembekal_negeri') ?>

    <?php // echo $form->field($model, 'alamat_pembekal_bandar') ?>

    <?php // echo $form->field($model, 'alamat_pembekal_poskod') ?>

    <?php // echo $form->field($model, 'perkara') ?>

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
