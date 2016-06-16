<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikal */

$this->title = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
        'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
        'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
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
