<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanDokumenSokonganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'e-Laporan Dokumen Sokongan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-dokumen-sokongan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah e-Laporan Dokumen Sokongan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_dokumen_sokongan_id',
            //'elaporan_pelaksaan_id',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            [
                'attribute' => 'muat_nail',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::muat_nail,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
