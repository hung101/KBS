<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenilaianPrestasiAtletSasaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaian Prestasi Atlet Sasarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-prestasi-atlet-sasaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Penilaian Prestasi Atlet Sasaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'penilaian_prestasi_atlet_sasaran_id',
            'penilaian_pestasi_id',
            'atlet',
            'sasaran',
            'keputusan',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
