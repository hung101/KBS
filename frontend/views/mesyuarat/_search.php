<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mesyuarat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mesyuarat_id') ?>

    <?= $form->field($model, 'bil_mesyuarat') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'masa') ?>

    <?= $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'pengurusi') ?>

    <?php // echo $form->field($model, 'pencatat_minit') ?>

    <?php // echo $form->field($model, 'perkara_perkara_dan_tindakan') ?>

    <?php // echo $form->field($model, 'mesyuarat_tamat') ?>

    <?php // echo $form->field($model, 'mesyuarat_seterusnya') ?>

    <?php // echo $form->field($model, 'disedia_oleh') ?>

    <?php // echo $form->field($model, 'disemak_oleh') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
