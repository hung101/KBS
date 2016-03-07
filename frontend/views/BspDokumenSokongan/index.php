<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspDokumenSokonganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dokumen Sokongan Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-dokumen-sokongan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Dokumen Sokongan Biasiswa Sukan Persekutuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_dokumen_sokongan_id',
            //'bsp_pemohon_id',
            'nama_dokumen',
            'upload',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
