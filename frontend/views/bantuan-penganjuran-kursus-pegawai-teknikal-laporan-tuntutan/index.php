<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporan Tuntutans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-tuntutan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bantuan Penganjuran Kursus Pegawai Teknikal Laporan Tuntutan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id',
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id',
            'kejohanan_kursus_seminar_bengkel',
            'tarikh_mula',
            'tarikh_tamat',
            // 'tempat',
            // 'jumlah_kelulusan',
            // 'pendahuluan_80',
            // 'no_cek',
            // 'no_boucer',
            // 'jumlah_yang_dituntut_20',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
