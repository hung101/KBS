<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan */

//$this->title = 'Update Bantuan Penganjuran Kursus Pegawai Teknikal Laporan: ' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id;
$this->title = GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal_laporan;
if($model->bantuan_penganjuran_kursus_id && $model->bantuan_penganjuran_kursus_id != 0){
    $this->title =  GeneralLabel::laporan . ' ' . GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar;
}elseif($model->bantuan_penganjuran_kursus_pegawai_teknikal_id && $model->bantuan_penganjuran_kursus_pegawai_teknikal_id != 0){
    $this->title =  GeneralLabel::laporan . ' ' . GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal;
}elseif($model->bantuan_penyertaan_pegawai_teknikal_id && $model->bantuan_penyertaan_pegawai_teknikal_id != 0){
    $this->title =  GeneralLabel::laporan . ' ' . GeneralLabel::bantuan_penyertaan_pegawai_teknikal;
}
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
