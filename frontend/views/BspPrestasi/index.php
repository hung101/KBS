<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPrestasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestasi Semester';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Prestasi Semester', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_prestasi_id',
            //'bsp_pemohon_id',
            'laporan_ulasan',
            'nyatakan_sebab_sebab_tidak_menyertai_kejohanan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
