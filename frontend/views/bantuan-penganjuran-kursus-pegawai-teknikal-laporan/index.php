<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bantuan Penganjuran Kursus Pegawai Teknikal Laporan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id',
            'tarikh',
            'tempat',
            'tujuan_kursus_kejohanan',
            'bilangan_pasukan',
            // 'bilangan_peserta',
            // 'bilangan_pegawai_teknikal',
            // 'bilangan_pembantu',
            // 'laporan_bergambar',
            // 'penyata_perbelanjaan_resit_yang_telah_disahkan',
            // 'jadual_keputusan_pertandingan',
            // 'senarai_peserta',
            // 'statistik_penyertaan',
            // 'senarai_pegawai_penceramah',
            // 'senarai_urusetia_sukarelawan',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
