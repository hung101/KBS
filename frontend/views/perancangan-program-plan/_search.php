<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerancanganProgramPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perancangan-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'perancangan_program_plan_master_id') ?>

    <?= $form->field($model, 'cawangan') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'program') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
