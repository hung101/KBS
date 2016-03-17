<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanPelaksaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'e-Laporan Pelaksaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah e-Laporan Pelaksaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksaan_id',
            'nama_projek_program_aktiviti_kejohanan',
            'nama_persatuan',
            'jumlah_bantuan',
            // 'no_cek_eft',
            // 'tarikh_cek_eft',
            // 'objektif_pelaksaan',
            // 'tarikh_dilaksanakan',
            // 'tempat',
            // 'dirasmikan_oleh',
            // 'jumlah_penyertaan_keseluruhan',
            // 'keberkesanan_pelaksaan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
