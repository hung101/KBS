<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AkademiAkk */

$this->title = GeneralLabel::createTitle . ' AKK';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akademi_kejurulatihan_kebangsaan_akk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akademi-akk-create">

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
        'readonly' => $readonly,
    ]) ?>

</div>
