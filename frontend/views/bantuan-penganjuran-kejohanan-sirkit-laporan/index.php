<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKejohananLaporanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bantuan Penganjuran Kejohanan Laporans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-sirkit-laporan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bantuan Penganjuran Kejohanan Laporan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penganjuran_kejohanan_laporan_id',
            'bantuan_penganjuran_kejohanan_id',
            'tarikh',
            'tempat',
            'tujuan_penganjuran',
            // 'bilangan_pasukan',
            // 'bilangan_peserta',
            // 'bilangan_pegawai_teknikal',
            // 'bilangan_pembantu',
            // 'laporan_bergambar',
            // 'penyata_perbelanjaan_resit_yang_telah_disahkan',
            // 'jadual_keputusan_pertandingan',
            // 'senarai_pasukan',
            // 'senarai_statistik_penyertaan',
            // 'senarai_pegawai_pembantu_teknikal',
            // 'senarai_urusetia_sukarelawan',
            // 'senarai_pegawai_pembantu_perubatan',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
