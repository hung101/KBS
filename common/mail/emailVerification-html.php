<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activateLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->email_verify_token, 'access_id' => $user->category_access, 'email' => $user->email]);
?>
<div class="password-reset">
    <!--<p>Hello <?= Html::encode($user->username) ?>,</p>-->
    
    <p>Salam Sejahtera <?= ($user->nama_persatuan_e_bantuan != '') ? Html::encode($user->nama_persatuan_e_bantuan) . ' - ' : ''; ?> <?= Html::encode($user->username) ?>,</p>

    <!--<p>Follow the link below to reset your password:</p>-->
    
    <p>Sila klik link di bawah untuk mengaktifkan akaun anda:</p>

    <p><?= Html::a(Html::encode($activateLink), $activateLink) ?></p>
</div>
