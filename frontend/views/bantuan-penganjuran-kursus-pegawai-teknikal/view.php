<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikal */

//$this->title = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus-pegawai-teknikal']['create']) && $model->hantar_flag == 0)): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                    'method' => 'post',
                ],
                ]) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus-pegawai-teknikal']['update']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus-pegawai-teknikal']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus-pegawai-teknikal']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
		<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus-pegawai-teknikal']['update']) && $model->hantar_flag == 1): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalElemen' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalElemen,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalElemen' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalElemen,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penganjuran_kursus_pegawai_teknikal_id',
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
            'nama_kursus_seminar_bengkel',
            'tarikh',
            'tempat',
            'tujuan',
            'yuran_penyertaan',
            'surat_rasmi_badan_sukan',
            'surat_jemputan_daripada_pengelola',
            'butiran_perbelanjaan',
            'salinan_passport',
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
