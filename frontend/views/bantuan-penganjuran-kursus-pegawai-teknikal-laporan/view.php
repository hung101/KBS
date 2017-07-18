<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan */

//$this->title = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penganjuran_kejohanan_laporan;
//$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(($model->hantar_flag == 0)): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                    'method' => 'post',
                ],
                ]) ?>
        <?php endif; ?>
        <?php if( $model->hantar_flag == 0 || 
                (isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['kelulusan']) ||
                isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penyertaan-pegawai-teknikal']['kelulusan']) ||
                isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus-pegawai-teknikal']['kelulusan'])) ): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(($model->hantar_flag == 1)): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
        <?php /*echo Html::a('Delete', ['delete', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);*/ ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id',
            'tarikh',
            'tempat',
            'tujuan_kursus_kejohanan',
            'bilangan_pasukan',
            'bilangan_peserta',
            'bilangan_pegawai_teknikal',
            'bilangan_pembantu',
            'laporan_bergambar',
            'penyata_perbelanjaan_resit_yang_telah_disahkan',
            'jadual_keputusan_pertandingan',
            'senarai_peserta',
            'statistik_penyertaan',
            'senarai_pegawai_penceramah',
            'senarai_urusetia_sukarelawan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
