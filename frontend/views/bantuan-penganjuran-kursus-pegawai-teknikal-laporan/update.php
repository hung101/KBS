<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan */

//$this->title = 'Update Bantuan Penganjuran Kursus Pegawai Teknikal Laporan: ' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id;
$this->title = GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal_laporan;
//$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporans', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        'readonly' => $readonly,
    ]) ?>

</div>
