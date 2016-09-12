<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkitLaporan */

//$this->title = $model->bantuan_penganjuran_kejohanan_laporan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penganjuran_kejohanan_laporan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-sirkit-laporan-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id], ['class' => 'btn btn-primary']) ?>

        <?php /*echo Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]);*/ ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan,
        'dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penganjuran_kejohanan_laporan_id',
            'bantuan_penganjuran_kejohanan_id',
            'tarikh',
            'tempat',
            'tujuan_penganjuran',
            'bilangan_pasukan',
            'bilangan_peserta',
            'bilangan_pegawai_teknikal',
            'bilangan_pembantu',
            'laporan_bergambar',
            'penyata_perbelanjaan_resit_yang_telah_disahkan',
            'jadual_keputusan_pertandingan',
            'senarai_pasukan',
            'senarai_statistik_penyertaan',
            'senarai_pegawai_pembantu_teknikal',
            'senarai_urusetia_sukarelawan',
            'senarai_pegawai_pembantu_perubatan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
