<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanPelaksanaanKekuranganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::elaporan_pelaksanaan_kekurangan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kekurangan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::create.' '.GeneralLabel::elaporan_pelaksanaan_kekurangan, ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_kekurangan_id',
            //'elaporan_pelaksaan_id',
            [
                'attribute' => 'kekurangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kekurangan,
                ]
            ],
            //'session_id',
            //,
            // ,
            // ,
            // ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
