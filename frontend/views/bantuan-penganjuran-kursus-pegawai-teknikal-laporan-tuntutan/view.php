<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan */

$this->title = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporan Tuntutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-tuntutan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id',
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id',
            'kejohanan_kursus_seminar_bengkel',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'jumlah_kelulusan',
            'pendahuluan_80',
            'no_cek',
            'no_boucer',
            'jumlah_yang_dituntut_20',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
