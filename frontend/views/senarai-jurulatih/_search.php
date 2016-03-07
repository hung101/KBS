<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SenaraiJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="senarai-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'senarai_jurulatih_id') ?>

    <?= $form->field($model, 'pengurusan_jkk_jkp_program_id') ?>

    <?= $form->field($model, 'jurulatih') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
