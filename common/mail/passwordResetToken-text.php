<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = null;

if($user->category_access){
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token, 'access_id' => $user->category_access]);
} else {
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
}
?>
Salam Sejahtera <?= $user->username ?>,

Sila klik link di bawah untuk menetapkan semula kata laluan anda:

<?= $resetLink ?>
