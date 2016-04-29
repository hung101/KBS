<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AkademiAkk */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::akademi_akk.': ' . ' ' . $model->akademi_akk_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_lesen;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_lesen, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_lesen, 'url' => ['view', 'id' => $model->akademi_akk_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akademi-akk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelKegiatanPengalamanJurulatihAkk' => $searchModelKegiatanPengalamanJurulatihAkk,
        'dataProviderKegiatanPengalamanJurulatihAkk' => $dataProviderKegiatanPengalamanJurulatihAkk,
        'searchModelKegiatanPengalamanAtletAkk' => $searchModelKegiatanPengalamanAtletAkk,
        'dataProviderKegiatanPengalamanAtletAkk' => $dataProviderKegiatanPengalamanAtletAkk,
        'searchModelKelayakanAkademiAkk' => $searchModelKelayakanAkademiAkk,
        'dataProviderKelayakanAkademiAkk' => $dataProviderKelayakanAkademiAkk,
        'searchModelKelayakanSukanSpesifikAkk' => $searchModelKelayakanSukanSpesifikAkk,
        'dataProviderKelayakanSukanSpesifikAkk' => $dataProviderKelayakanSukanSpesifikAkk,
        'searchModelPemohonKursusTahapAkk' => $searchModelPemohonKursusTahapAkk,
        'dataProviderPemohonKursusTahapAkk' => $dataProviderPemohonKursusTahapAkk,
        'searchModelAkkSijilPertolonganCemas' => $searchModelAkkSijilPertolonganCemas,
        'dataProviderAkkSijilPertolonganCemas' => $dataProviderAkkSijilPertolonganCemas,
        'searchModelAkkSijilCpr' => $searchModelAkkSijilCpr,
        'dataProviderAkkSijilCpr' => $dataProviderAkkSijilCpr,
        'searchModelAkkPermitKerja' => $searchModelAkkPermitKerja,
        'dataProviderAkkPermitKerja' => $dataProviderAkkPermitKerja,
        'readonly' => $readonly,
    ]) ?>

</div>
