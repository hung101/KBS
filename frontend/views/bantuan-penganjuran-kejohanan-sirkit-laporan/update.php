<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkitLaporan */

//$this->title = 'Update Bantuan Penganjuran Kejohanan Laporan: ' . $model->bantuan_penganjuran_kejohanan_laporan_id;
$this->title = GeneralLabel::bantuan_penyertaan_kejohanan_laporan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kejohanan_laporan, 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penganjuran_kejohanan_laporan, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-sirkit-laporan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan,
        'dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan,
        'readonly' => $readonly,
    ]) ?>

</div>
