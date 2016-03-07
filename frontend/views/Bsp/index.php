<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemohon Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pemohon Biasiswa Sukan Persekutuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_pemohon_id',
            //'atlet_id',
            'peringkat_pengajian',
            'bidang_pengajian',
            'falkuti_pengajian',
            'ipt',
            // 'tahun_mula_pengajian',
            // 'tahun_tamat_pengajian',
            // 'tahun_ditawarkan_biasiswa',
            // 'kelulusan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
