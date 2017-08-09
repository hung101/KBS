<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkit */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_penganjuran_sirkit_remaja_karnival;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran_sirkit_remaja_karnival, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penganjuran_sirkit_remaja_karnival, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananSirkitKewangan' => $searchModelBantuanPenganjuranKejohananSirkitKewangan,
        'dataProviderBantuanPenganjuranKejohananSirkitKewangan' => $dataProviderBantuanPenganjuranKejohananSirkitKewangan,
        'searchModelBantuanPenganjuranKejohananSirkitBayaran' => $searchModelBantuanPenganjuranKejohananSirkitBayaran,
        'dataProviderBantuanPenganjuranKejohananSirkitBayaran' => $dataProviderBantuanPenganjuranKejohananSirkitBayaran,
        'searchModelBantuanPenganjuranKejohananSirkitElemen' => $searchModelBantuanPenganjuranKejohananSirkitElemen,
        'dataProviderBantuanPenganjuranKejohananSirkitElemen' => $dataProviderBantuanPenganjuranKejohananSirkitElemen,
        'searchModelBantuanPenganjuranKejohananSirkitDianjurkan' => $searchModelBantuanPenganjuranKejohananSirkitDianjurkan,
        'dataProviderBantuanPenganjuranKejohananSirkitDianjurkan' => $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan,
        'searchModelBantuanPenganjuranKejohananSirkitOlehMsn' => $searchModelBantuanPenganjuranKejohananSirkitOlehMsn,
        'dataProviderBantuanPenganjuranKejohananSirkitOlehMsn' => $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn,
        'searchModelBantuanPenganjuranKejohananSirkitSukan' => $searchModelBantuanPenganjuranKejohananSirkitSukan,
        'dataProviderBantuanPenganjuranKejohananSirkitSukan' => $dataProviderBantuanPenganjuranKejohananSirkitSukan,
        'readonly' => $readonly,
    ]) ?>

</div>
