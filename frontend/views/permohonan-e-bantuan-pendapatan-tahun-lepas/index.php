<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanPendapatanTahunLepasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendapatan Tahun Lepas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-pendapatan-tahun-lepas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pendapatan Tahun Lepas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pendapatan_tahun_lepas_id',
            //'permohonan_e_bantuan_id',
            [
                'attribute' => 'jenis_pendapatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_pendapatan,
                ]
            ],
            [
                'attribute' => 'butir_butir',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::butir_butir,
                ]
            ],
            [
                'attribute' => 'jumlah_pendapatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_pendapatan,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
