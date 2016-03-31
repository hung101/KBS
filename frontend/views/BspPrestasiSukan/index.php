<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPrestasiSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestasi Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-sukan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Prestasi Sukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_prestasi_sukan_id',
            //'bsp_pemohon_id',
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],
            [
                'attribute' => 'kejohanan_yang_disertai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kejohanan_yang_disertai,
                ]
            ],
            [
                'attribute' => 'lokasi_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::lokasi_kejohanan,
                ]
            ],
            // 'pencapaian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
