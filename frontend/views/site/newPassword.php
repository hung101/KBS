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

    <p>Sila mengisi bidang-bidang kata laluan baru:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php

use app\models\general\GeneralLabel;
 $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'confirm_password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Hantar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php

use app\models\general\GeneralLabel;
 ActiveForm::end(); ?>
        </div>
    </div>
</div>
