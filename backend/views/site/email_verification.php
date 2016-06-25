<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = GeneralLabel::email_verification;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-email-verification">
    <h1><?= Html::encode($this->title) ?></h1>

    <h3>Terima kasih kerana mendaftar</h3>
    

            <p><?=GeneralLabel::email_verification_message?></p>
</div>
