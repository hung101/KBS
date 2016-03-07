<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RehabilitasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rehabilitasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Rehabilitasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'rehabilitasi_id',
            //'pl_diagnosis_preskripsi_pemeriksaan_id',
            'tarikh',
            'kesan_klinikal',
            'masalah_yang_dikenal_pasti',
            // 'potensi_rehabilitasi',
            // 'matlamat_rehabilitasi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
