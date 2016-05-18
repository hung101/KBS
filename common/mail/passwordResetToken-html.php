<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token, 'access_id' => $user->category_access]);
?>
<div class="password-reset">
    <!--<p>Hello <?= Html::encode($user->username) ?>,</p>-->
    
    <p>Salam Sejahtera <?= Html::encode($user->username) ?>,</p>

    <!--<p>Follow the link below to reset your password:</p>-->
    
    <p>Sila klik link di bawah untuk menetapkan semula kata laluan anda:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
