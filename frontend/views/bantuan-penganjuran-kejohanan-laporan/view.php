<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananLaporan */

$this->title = $model->bantuan_penganjuran_kejohanan_laporan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Laporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-laporan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananLaporanTuntutan,
        'dataProviderBantuanPenganjuranKejohananLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananLaporanTuntutan,
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
