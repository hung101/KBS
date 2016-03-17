<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanPelaksanaanObjektifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objektif Pelaksanaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-objektif-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Objektif Pelaksanaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_objektif_id',
            //'elaporan_pelaksaan_id',
            'objektif_pelaksanaan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
