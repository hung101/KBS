<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKemudahanPeralatanSediaAdaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kemudahan-peralatan-sedia-ada-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kemudahan_peralatan_sedia_ada_id') ?>

    <?= $form->field($model, 'pengurusan_kemudahan_venue_id') ?>

    <?= $form->field($model, 'nama_peralatan') ?>

    <?= $form->field($model, 'kuantiti') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
