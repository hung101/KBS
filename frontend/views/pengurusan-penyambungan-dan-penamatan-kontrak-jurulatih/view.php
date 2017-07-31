<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih */

//$this->title = $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pelanjutan_dan_penamatan_kontrak_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelanjutan_dan_penamatan_kontrak_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if( (isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['update']) && 
                ($model->status_tawaran_mpj == "" || $model->status_tawaran_mpj == "Dalam Proses")  && 
                ($model->status_tawaran_jkb == "" || $model->status_tawaran_jkb == "Dalam Proses") ) || 
                isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['status_permohonan']) ): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['delete'])): ?>
            <?php /*echo Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ])*/ ?>
        <?php endif; ?>
        <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php //if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['update'])): ?>
            <?= Html::a(GeneralLabel::pemantauan_jurulatih, ['/laporan-pemantauan-jurulatih/', 'jurulatih_id' => $jurulatih_id], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
        <?php //endif; ?>
        <?= Html::a(GeneralLabel::penilaian_jurulatih, ['/pengurusan-pemantauan-dan-penilaian-jurulatih/', 'jurulatih_id' => $jurulatih_id], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
        <!--<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['update'])): ?>
            <?= Html::a(GeneralLabel::laporan_jurulatih_wajaran, ['/jurulatih/laporan-jurulatih-wajaran/', 'id' => $jurulatih_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
        <?php endif; ?>-->
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id',
            'jurulatih',
            'muatnaik_gambar',
            'cawangan',
            'sub_cawangan',
            'program_msn',
            'lain_lain_program',
            'pusat_latihan',
            'nama_sukan',
            'nama_acara',
            'status_jurulatih',
            'status_permohonan',
            'status_keaktifan_jurulatih',
            'muat_naik_document',
        ],
    ]);*/ ?>

</div>
