<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspElaunLatihanPraktikalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Elaun Latihan Praktikal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Elaun Latihan Praktikal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_elaun_latihan_praktikal_id',
            //'bsp_pemohon_id',
            'tarikh',
            'jenis_latihan_amali',
            'tempat_latihan_praktikal',
            // 'tarikh_mula',
            // 'tarikh_tamat',
            // 'jumlah_hari',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
