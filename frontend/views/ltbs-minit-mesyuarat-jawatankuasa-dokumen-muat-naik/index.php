<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::muat_naik_minit_mesyuarat_jawatankuasa_menetapkan_mesyuarat_agong;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Muat Naik Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'dokumen_muat_naik_id',
            //'mesyuarat_id',
            [
                'attribute' => 'nama_dokumen',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_dokumen,
                ]
            ],
            [
                'attribute' => 'muat_naik',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::muat_naik,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
