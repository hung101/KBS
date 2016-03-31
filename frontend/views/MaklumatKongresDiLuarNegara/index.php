<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MaklumatKongresDiLuarNegaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maklumat Kongres Di Luar Negara';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-kongres-di-luar-negara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Maklumat Kongres Di Luar Negara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'maklumat_kongres_di_luar_negara_id',
            //'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id',
            [
                'attribute' => 'tajuk',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tajuk,
                ]
            ],
            [
                'attribute' => 'tempat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tempat,
                ]
            ],
            [
                'attribute' => 'masa',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::masa,
                ]
            ],
            // 'tarikh_penerbangan',
            // 'tiket_penerbangan',
            // 'jumlah_penerbangan',
            // 'lain_lain',
            // 'jumlah_kos_lain_lain',
            // 'nama_pegawai_terlibat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
