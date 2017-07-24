<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan */

$this->title = GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal_laporan;
if($model->bantuan_penganjuran_kursus_id && $model->bantuan_penganjuran_kursus_id != 0){
    $this->title =  GeneralLabel::laporan . ' ' . GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar;
}elseif($model->bantuan_penganjuran_kursus_pegawai_teknikal_id && $model->bantuan_penganjuran_kursus_pegawai_teknikal_id != 0){
    $this->title =  GeneralLabel::laporan . ' ' . GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal;
}elseif($model->bantuan_penyertaan_pegawai_teknikal_id && $model->bantuan_penyertaan_pegawai_teknikal_id != 0){
    $this->title =  GeneralLabel::laporan . ' ' . GeneralLabel::bantuan_penyertaan_pegawai_teknikal;
}
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal_laporan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        'readonly' => $readonly,
    ]) ?>

</div>
