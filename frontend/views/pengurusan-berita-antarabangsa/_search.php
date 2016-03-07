<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanBeritaAntarabangsaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-berita-antarabangsa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_berita_antarabangsa_id') ?>

    <?= $form->field($model, 'kategori_berita') ?>

    <?= $form->field($model, 'nama_berita') ?>

    <?= $form->field($model, 'tarikh_berita') ?>

    <?= $form->field($model, 'muatnaik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
