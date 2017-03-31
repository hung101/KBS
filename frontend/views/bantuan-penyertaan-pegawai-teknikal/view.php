<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikal */

//$this->title = $model->bantuan_penyertaan_pegawai_teknikal_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penyertaan_pegawai_teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penyertaan_pegawai_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penyertaan-pegawai-teknikal-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penyertaan-pegawai-teknikal']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penyertaan-pegawai-teknikal']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
		<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penyertaan-pegawai-teknikal']['update'])): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
        'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
        'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
        'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
        'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
        'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penyertaan_pegawai_teknikal_id',
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
            'nama_kejohanan',
            'peringkat',
            'peringkat_lain_lain',
            'tarikh',
            'tempat',
            'tujuan',
            'surat_rasmi_badan_sukan_ms_negeri',
            'surat_jemputan_lantikan_daripada_pengelola',
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
