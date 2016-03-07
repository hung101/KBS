<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LatihanDanProgramPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maklumat Peserta Latihan Dan Program';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="latihan-dan-program-peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Maklumat Peserta Latihan Dan Program', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'latihan_dan_program_peserta_id',
            //'latihan_dan_program_id',
            'nama',
            'no_kad_pengenalan',
            'nama_badan_sukan',
            // 'no_pendaftaran_sukan',
            // 'jawatan',
            // 'tempoh_memegang_jawatan',
            // 'no_tel_bimbit',
            // 'emel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
