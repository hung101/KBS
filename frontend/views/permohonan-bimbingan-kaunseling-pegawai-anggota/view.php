<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBimbinganKaunselingPegawaiAnggota */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_bimbingan_kaunseling_pegawai_anggota;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_bimbingan_kaunseling_pegawai_anggota, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-bimbingan-kaunseling-pegawai-anggota-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_bimbingan_kaunseling_pegawai_anggota_id',
            'nama',
            'jawatan',
            'no_kad_pengenalan',
            'umur',
            'no_telefon',
            'emel',
            'bahagian',
            'taraf_perkahwinan',
            'status_jawatan',
            'jantina',
            'tarikh_temujanji',
            'kategori_masalah',
            'catatan_kaunselor',
            'tindakan_kaunselor',
            'cadangan_kaunselor',
            'tarikh_permohonan',
            'status_permohonan',
            'catatan_permohonan',
            'nama_pegawai_anggota',
            'no_kad_pengenalan_pegawai',
            'umur_pegawai',
            'jawatan_pegawai',
            'bahagian_pegawai',
            'no_tel_pegawai',
            'emel_pegawai',
            'taraf_perkahwinan_pegawai',
            'status_jawatan_pegawai',
            'jantina_pegawai',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
