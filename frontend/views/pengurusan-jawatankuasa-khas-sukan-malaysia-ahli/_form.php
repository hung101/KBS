<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJawatankuasaKhasSukanMalaysiaAhli */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-ahli-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenis_keahlian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_keahlian_nyatakan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput() ?>

    <?= $form->field($model, 'jawatan')->textInput() ?>

    <?= $form->field($model, 'agensi_organisasi')->textInput() ?>

    <?= $form->field($model, 'agensi_organisasi_nyatakan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'negeri')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
