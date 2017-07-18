<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikal */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalElemen' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalElemen,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalElemen' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalElemen,
        'readonly' => $readonly,
    ]) ?>

</div>
