<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View Atlet::findOne($id)*/
/* @var $searchModel frontend\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bantuan Penganjuran Kursus Pegawai Teknikal Dicadangkans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-dicadangkan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bantuan Penganjuran Kursus Pegawai Teknikal Dicadangkan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id',
            'bantuan_penganjuran_kursus_pegawai_teknikal_id',
            'badan_sukan',
            'sukan',
            'nama',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_kad_pengenalan',
            // 'umur',
            // 'no_passport',
            // 'jantina',
            // 'no_telefon',
            // 'alamat_e_mail',
            // 'tahap_akademik',
            // 'tahap_kelayakan_sukan_peringkat_kebangsaan',
            // 'tahap_kelayakan_sukan_peringkat_antarabangsa',
            // 'nama_majikan',
            // 'no_telefon_majikan',
            // 'no_faks',
            // 'jawatan',
            // 'gred',
            // 'nama_kejohanan_kursus',
            // 'tarikh_mula',
            // 'tarikh_tamat',
            // 'tempat',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
