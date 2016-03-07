<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ElaporanPelaksanaanObjektifSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-pelaksanaan-objektif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'elaporan_pelaksanaan_objektif_id') ?>

    <?= $form->field($model, 'elaporan_pelaksaan_id') ?>

    <?= $form->field($model, 'objektif_pelaksanaan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
