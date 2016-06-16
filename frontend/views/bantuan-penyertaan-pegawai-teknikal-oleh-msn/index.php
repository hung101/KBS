<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenyertaanPegawaiTeknikalOlehMsnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bantuan Penyertaan Pegawai Teknikal Oleh Msns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penyertaan-pegawai-teknikal-oleh-msn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bantuan Penyertaan Pegawai Teknikal Oleh Msn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penyertaan_pegawai_teknikal_oleh_msn_id',
            'bantuan_penyertaan_pegawai_teknikal_id',
            'kejohanan',
            'tarikh_mula',
            'tarikh_tamat',
            // 'tempat',
            // 'status_penganjuran',
            // 'jumlah_bantuan',
            // 'laporan_dikemukakan',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
