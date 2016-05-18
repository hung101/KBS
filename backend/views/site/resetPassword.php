<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = GeneralLabel::reset_password;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Sila masukkan kata laluan baru anda:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 160]) ?>
                <div class="form-group">
                    <?= Html::submitButton(GeneralLabel::save, ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
