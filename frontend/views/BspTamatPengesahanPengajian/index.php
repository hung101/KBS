<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspTamatPengesahanPengajianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tamat Pengesahan Pengajian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tamat-pengesahan-pengajian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Tamat Pengesahan Pengajian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_tamat_pengesahan_pengajian_id',
            'nama_ipts',
            'pengajian',
            'bidang',
            //'cgpa_pngk',
            // 'tarikh_tamat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
