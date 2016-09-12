<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkit */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_penganjuran_sirkit_remaja_karnival;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran_sirkit_remaja_karnival, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-create">

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
        'readonly' => $readonly,
    ]) ?>

</div>
