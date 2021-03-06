<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = GeneralLabel::tambah_user;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>Please fill out the following fields to signup:</p>-->

    <div class="row">
        <div class="col-lg-5">
            <?php
 $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'full_name') ?>
            <?= $form->field($model, 'tel_bimbit_no') ?>
                <div class="form-group">
                    <?= Html::submitButton('Hantar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php
 ActiveForm::end(); ?>
        </div>
    </div>
</div>
