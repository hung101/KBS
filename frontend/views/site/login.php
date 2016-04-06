<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = GeneralLabel::login;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Sila mengisi bidang-bidang berikut untuk login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php

use app\models\general\GeneralLabel;
 $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#999;margin:1em 0">
                    Jika anda terlupa kata laluan anda, anda boleh <?= Html::a('menetapkan semula', ['site/request-password-reset']) ?>.
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Log Masuk', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <!-- <?= Html::a('Log Masuk Kali Pertama', ['new-password'], ['class' => 'btn btn-warning']) ?> -->
                </div>
            <?php

use app\models\general\GeneralLabel;
 ActiveForm::end(); ?>
        </div>
    </div>
</div>
