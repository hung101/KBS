<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\InformasiPersatuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Informasi Persatuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasi-persatuan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Informasi Persatuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'informasi_persatuan_id',
            'nama_persatuan',
            //'alamat_1',
            //'alamat_2',
            //'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
             'no_tel',
            // 'no_faks',
            // 'emel',
             'laman_web',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
