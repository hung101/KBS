<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanPelaksanaanKerjasamaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kerjasama';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kerjasama-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kerjasama', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_kerjasama_id',
            //'elaporan_pelaksaan_id',
            'nama_kerjasama',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
