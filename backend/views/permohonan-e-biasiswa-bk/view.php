<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */

//$this->title = $model->permohonan_e_biasiswa_id;
$this->title = GeneralLabel::viewTitle . ' Permohonan E-Biasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan E-Biasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_e_biasiswa_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_e_biasiswa_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
        'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
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
