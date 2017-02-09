<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPerlanjutanDokumenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dokumen Pelanjutan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-dokumen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Dokumen Pelanjutan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_perlanjutan_dokumen_id',
            //'bsp_perlanjutan_id',
            'nama_dokumen',
            'upload',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
