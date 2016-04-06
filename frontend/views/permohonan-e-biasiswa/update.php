<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;
use app\models\UserPeranan;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebiasiswa.': ' . ' ' . $model->permohonan_e_biasiswa_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan e-Biasiswa';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebiasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan e-Biasiswa', 'url' => ['view', 'id' => $model->permohonan_e_biasiswa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-update">
    
    <?php 
        if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_KBS_E_BIASISWA_BENDAHARI_IPT){ // START for Bendahari IPT
            $this->title = GeneralLabel::updateTitle . ' Yuran Pengajian';
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
