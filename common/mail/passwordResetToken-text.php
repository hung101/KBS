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
Assalamualaikum dan Salam Sejahtera [<?= $user->username ?>],

Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan,

PENETAPAN SEMULA AKAUN SISTEM SPSB

Dengan segala hormatnya perkara di atas adalah dirujuk.

2. Id pengguna Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan adalah seperti berikut:
Nama Penuh   : <?= $user->full_name ?>
Id Pengguna   : <?= $user->username ?>

3. Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan dipohon untuk menetapkan semula kata laluan. Sila klik link di bawah:
<?= $resetLink ?>

4. Kerjasama dan perhatian Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan dalam perkara ini amat dihargai dan didahului dengan ucapan terima kasih.

Sekian.
