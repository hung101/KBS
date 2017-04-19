<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkit */

//$this->title = $model->bantuan_penganjuran_kejohanan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penganjuran_sirkit_remaja_karnival;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran_sirkit_remaja_karnival, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan-sirkit']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_penganjuran_kejohanan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan-sirkit']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_penganjuran_kejohanan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
		<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan-sirkit']['update'])): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->bantuan_penganjuran_kejohanan_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananSirkitKewangan' => $searchModelBantuanPenganjuranKejohananSirkitKewangan,
        'dataProviderBantuanPenganjuranKejohananSirkitKewangan' => $dataProviderBantuanPenganjuranKejohananSirkitKewangan,
        'searchModelBantuanPenganjuranKejohananSirkitBayaran' => $searchModelBantuanPenganjuranKejohananSirkitBayaran,
        'dataProviderBantuanPenganjuranKejohananSirkitBayaran' => $dataProviderBantuanPenganjuranKejohananSirkitBayaran,
        'searchModelBantuanPenganjuranKejohananSirkitElemen' => $searchModelBantuanPenganjuranKejohananSirkitElemen,
        'dataProviderBantuanPenganjuranKejohananSirkitElemen' => $dataProviderBantuanPenganjuranKejohananSirkitElemen,
        'searchModelBantuanPenganjuranKejohananSirkitDianjurkan' => $searchModelBantuanPenganjuranKejohananSirkitDianjurkan,
        'dataProviderBantuanPenganjuranKejohananSirkitDianjurkan' => $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan,
        'searchModelBantuanPenganjuranKejohananSirkitOlehMsn' => $searchModelBantuanPenganjuranKejohananSirkitOlehMsn,
        'dataProviderBantuanPenganjuranKejohananSirkitOlehMsn' => $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penganjuran_kejohanan_id',
            'badan_sukan',
            'sukan',
            'no_pendaftaran',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_telefon',
            'no_faks',
            'laman_sesawang',
            'facebook',
            'twitter',
            'nama_bank',
            'no_akaun',
            'nama_kejohanan_pertandingan',
            'peringkat',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'tujuan',
            'bil_pasukan',
            'bil_peserta',
            'bil_pengadil_hakim',
            'bil_pegawai_teknikal',
            'bilangan_pembantu',
            'anggaran_perbelanjaan',
            'kertas_kerja',
            'surat_rasmi_badan_sukan_ms_negeri',
            'permohonan_rasmi_dari_ahli_gabungan',
            'maklumat_lain_sokongan',
            'jumlah_bantuan_yang_dipohon',
            'status_permohonan',
            'catatan',
            'tarikh_permohonan',
            'jumlah_dilulus',
            'jkb',
            'tarikh_jkb',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
