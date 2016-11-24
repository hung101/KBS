<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = GeneralLabel::new_password;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=GeneralLabel::sila_mengisi_bidang_bidang_kata_laluan_baru?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php

 $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'confirm_password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton(GeneralLabel::send, ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php
 ActiveForm::end(); ?>
        </div>
    </div>
</div>
