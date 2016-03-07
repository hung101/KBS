<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PeningkatanKerjayaJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peningkatan-kerjaya-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'peningkatan_kerjaya_jurulatih_id') ?>

    <?= $form->field($model, 'nama_jurulatih') ?>

    <?= $form->field($model, 'cawangan') ?>

    <?= $form->field($model, 'sub_cawangan') ?>

    <?= $form->field($model, 'program_msn') ?>

    <?php // echo $form->field($model, 'lain_lain_program') ?>

    <?php // echo $form->field($model, 'pusat_latihan') ?>

    <?php // echo $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'nama_acara') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
