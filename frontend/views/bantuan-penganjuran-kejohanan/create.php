<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohanan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::bantuan_penganjuran_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananKewangan' => $searchModelBantuanPenganjuranKejohananKewangan,
        'dataProviderBantuanPenganjuranKejohananKewangan' => $dataProviderBantuanPenganjuranKejohananKewangan,
        'searchModelBantuanPenganjuranKejohananBayaran' => $searchModelBantuanPenganjuranKejohananBayaran,
        'dataProviderBantuanPenganjuranKejohananBayaran' => $dataProviderBantuanPenganjuranKejohananBayaran,
        'searchModelBantuanPenganjuranKejohananElemen' => $searchModelBantuanPenganjuranKejohananElemen,
        'dataProviderBantuanPenganjuranKejohananElemen' => $dataProviderBantuanPenganjuranKejohananElemen,
        'searchModelBantuanPenganjuranKejohananDianjurkan' => $searchModelBantuanPenganjuranKejohananDianjurkan,
        'dataProviderBantuanPenganjuranKejohananDianjurkan' => $dataProviderBantuanPenganjuranKejohananDianjurkan,
        'searchModelBantuanPenganjuranKejohananOlehMsn' => $searchModelBantuanPenganjuranKejohananOlehMsn,
        'dataProviderBantuanPenganjuranKejohananOlehMsn' => $dataProviderBantuanPenganjuranKejohananOlehMsn,
        'readonly' => $readonly,
    ]) ?>

</div>
