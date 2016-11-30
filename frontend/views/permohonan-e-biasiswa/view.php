<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\UserPeranan;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */

//$this->title = $model->permohonan_e_biasiswa_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_ebiasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebiasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-view">
    
    <?php 
        if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_KBS_E_BIASISWA_BENDAHARI_IPT){ // START for Bendahari IPT
            $this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::yuran_pengajian;
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_e_biasiswa_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['delete'])): ?>
            <!--<?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_e_biasiswa_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>-->
        <?php endif; ?>
        <!-- eddie (print) start -->
        <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['update'])): ?>
        <?php endif; ?>
        <!-- eddie (print) end -->
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
        'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
        'searchModelBspPembayaran' => $searchModelBspPembayaran,
        'dataProviderBspPembayaran' => $dataProviderBspPembayaran,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_e_biasiswa_id',
            'muat_naik_gambar',
            'nama',
            'no_kad_pengenalan',
            'jantina',
            'keturunan',
            'agama',
            'taraf_perkahwinan',
            'kawasan_temuduga_anda',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel_bimbit',
            'no_pendaftaran_oku',
            'kategori_oku',
            'oku_lain_lain',
            'universiti_institusi',
            'program_pengajian',
            'kursus_bidang_pengajian',
            'falkulti',
            'kategori',
            'tarikh_tamat',
            'semester_terkini',
            'baki_semester_yang_tinggal',
            'no_matriks',
            'mendapat_pembiayaan_pendidikan',
            'sukan',
            'perakuan_pemohon',
            'kelulusan',
            'status_permohonan',
        ],
    ]);*/ ?>

</div>
