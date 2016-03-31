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
            [
                'attribute' => 'nama_projek_program_aktiviti_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_projek_program_aktiviti_kejohanan,
                ]
            ],
            [
                'attribute' => 'nama_persatuan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_persatuan,
                ]
            ],
            [
                'attribute' => 'jumlah_bantuan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_bantuan,
                ]
            ],
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
