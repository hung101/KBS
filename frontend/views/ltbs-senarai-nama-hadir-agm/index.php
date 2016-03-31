<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtbsSenaraiNamaHadirAgmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Nama Kehadiran Mesyuarat Agong';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-senarai-nama-hadir-agm-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Nama Kehadiran Mesyuarat Agong', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_nama_hadir_id',
            //'mesyuarat_agm_id',
            [
                'attribute' => 'nama_penuh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_penuh,
                ]
            ],
            [
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ]
            ],
            //'jantina',
            //'jawatan',
             [
                'attribute' => 'kategori_keahlian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_keahlian,
                ]
            ],
            // 'kehadiran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
