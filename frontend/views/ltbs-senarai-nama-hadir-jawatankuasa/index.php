<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtbsSenaraiNamaHadirJawatankuasaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Kehadiran Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-senarai-nama-hadir-jawatankuasa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kehadiran Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_nama_hadi_id',
            //'mesyuarat_id',
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
            [
                'attribute' => 'jawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan,
                ]
            ],
            //'jantina',
            //'kategori_keahlian',
            // 'kehadiran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
