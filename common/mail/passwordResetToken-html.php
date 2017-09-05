<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = null;

if($user->category_access){
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token, 'access_id' => $user->category_access]);
} else {
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
}
?>
<div class="password-reset">
    <!--<p>Hello <?= Html::encode($user->username) ?>,</p>-->
    
    <p>Assalamualaikum dan Salam Sejahtera <?= Html::encode($user->username) ?>,</p>
    <br>
Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan,
<br><br>
<b>PENETAPAN SEMULA AKAUN SISTEM SPSB</b>
<br><br>
Dengan segala hormatnya perkara di atas adalah dirujuk.
<br><br>
2. Id pengguna Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan adalah seperti berikut:
<br><br>Nama Penuh   : <?= Html::encode($user->full_name) ?>
<br><br>Id Pengguna   : <?= Html::encode($user->username) ?>
    <!--<p>Follow the link below to reset your password:</p>-->
<br><br>
3. Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan dipohon untuk menetapkan semula kata laluan. Sila klik link di bawah:

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
    
    <br>
4. Kerjasama dan perhatian Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan dalam perkara ini amat dihargai dan didahului dengan ucapan terima kasih.
<br><br>
Sekian.

</div>
