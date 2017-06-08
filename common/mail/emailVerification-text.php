<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activateLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->email_verify_token, 'access_id' => $user->category_access, 'email' => $user->email]);
?>
Salam Sejahtera <?= ($user->nama_persatuan_e_bantuan != '') ? $user->nama_persatuan_e_bantuan . ' - ' : ''; ?> <?= $user->username ?>,

Sila klik link di bawah untuk mengaktifkan akaun anda:

<?= $activateLink ?>
