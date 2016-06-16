<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan */

$this->title = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id',
            'tarikh',
            'tempat',
            'tujuan_kursus_kejohanan',
            'bilangan_pasukan',
            'bilangan_peserta',
            'bilangan_pegawai_teknikal',
            'bilangan_pembantu',
            'laporan_bergambar',
            'penyata_perbelanjaan_resit_yang_telah_disahkan',
            'jadual_keputusan_pertandingan',
            'senarai_peserta',
            'statistik_penyertaan',
            'senarai_pegawai_penceramah',
            'senarai_urusetia_sukarelawan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]) ?>

</div>
