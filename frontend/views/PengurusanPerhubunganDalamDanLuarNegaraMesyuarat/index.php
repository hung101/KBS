<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuaratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Perhubungan Dalam Dan Luar Negara Mesyuarat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhubungan-dalam-dan-luar-negara-mesyuarat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengurusan Perhubungan Dalam Dan Luar Negara Mesyuarat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id',
            'nama',
            'no_kad_pengenalan',
            'jawatan',
            //'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_tel_bimbit',
            // 'emel',
            // 'muatnaik_dokumen',
             'nama_kejohonan',
            // 'muatnaik_dokumen_kejohanan',
            // 'status_permohonan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
