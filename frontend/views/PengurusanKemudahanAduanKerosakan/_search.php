<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKemudahanAduanKerosakanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kemudahan-aduan-kerosakan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kemudahan_aduan_kerosakan_id') ?>

    <?= $form->field($model, 'pengurusan_kemudahan_aduan_id') ?>

    <?= $form->field($model, 'jenis_kerosakan') ?>

    <?= $form->field($model, 'lokasi_kerosakan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
