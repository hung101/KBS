<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohanan */

//$this->title = $model->bantuan_penganjuran_kejohanan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penganjuran_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_penganjuran_kejohanan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_penganjuran_kejohanan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['update'])): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->bantuan_penganjuran_kejohanan_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
        <?= Html::a(GeneralLabel::backToList, ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKejohananKewangan' => $searchModelBantuanPenganjuranKejohananKewangan,
        'dataProviderBantuanPenganjuranKejohananKewangan' => $dataProviderBantuanPenganjuranKejohananKewangan,
        'searchModelBantuanPenganjuranKejohananBayaran' => $searchModelBantuanPenganjuranKejohananBayaran,
        'dataProviderBantuanPenganjuranKejohananBayaran' => $dataProviderBantuanPenganjuranKejohananBayaran,
        'searchModelBantuanPenganjuranKejohananElemen' => $searchModelBantuanPenganjuranKejohananElemen,
        'dataProviderBantuanPenganjuranKejohananElemen' => $dataProviderBantuanPenganjuranKejohananElemen,
        'searchModelBantuanPenganjuranKejohananDianjurkan' => $searchModelBantuanPenganjuranKejohananDianjurkan,
        'dataProviderBantuanPenganjuranKejohananDianjurkan' => $dataProviderBantuanPenganjuranKejohananDianjurkan,
        'searchModelBantuanPenganjuranKejohananOlehMsn' => $searchModelBantuanPenganjuranKejohananOlehMsn,
        'dataProviderBantuanPenganjuranKejohananOlehMsn' => $dataProviderBantuanPenganjuranKejohananOlehMsn,
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
