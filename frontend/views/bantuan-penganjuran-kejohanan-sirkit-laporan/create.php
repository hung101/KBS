<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkitLaporan */

$this->title = GeneralLabel::bantuan_penganjuran_kejohanan_laporan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kejohanan_laporan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-sirkit-laporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan,
        'dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan,
        'readonly' => $readonly,
    ]) ?>

</div>
