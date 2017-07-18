<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursus */

//$this->title = $model->bantuan_penganjuran_kursus_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['create']) && $model->hantar_flag == 0)): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->bantuan_penganjuran_kursus_id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                    'method' => 'post',
                ],
                ]) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['update']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_penganjuran_kursus_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_penganjuran_kursus_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
		<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['update']) && $model->hantar_flag == 1): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->bantuan_penganjuran_kursus_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
        'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
        'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
        'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
        'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
        'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
        'searchModelBantuanPenganjuranKursusElemen' => $searchModelBantuanPenganjuranKursusElemen,
        'dataProviderBantuanPenganjuranKursusElemen' => $dataProviderBantuanPenganjuranKursusElemen,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penganjuran_kursus_id',
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
            'bil_penceramah',
            'bil_peserta',
            'bil_urusetia',
            'anggaran_perbelanjaan',
            'kertas_kerja',
            'surat_rasmi_badan_sukan_ms_negeri',
            'butiran_perbelanjaan',
            'maklumat_lain_sokongan',
            'jumlah_bantuan_yang_dipohon',
            'status_permohonan',
            'catatan',
            'tarikh_permohonan',
            'jumlah_dilulus',
            'jkb',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
