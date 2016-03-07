<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
use app\models\UserPeranan;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */

$this->title = GeneralLabel::createTitle . ' Permohonan e-Biasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan e-Biasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-create">
    <?php 
        if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_KBS_E_BIASISWA_BENDAHARI_IPT){ // START for Bendahari IPT
            $this->title = GeneralLabel::createTitle . ' Yuran Pengajian';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
        'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
        'searchModelBspPembayaran' => $searchModelBspPembayaran,
        'dataProviderBspPembayaran' => $dataProviderBspPembayaran,
        'readonly' => $readonly,
    ]) ?>

</div>
