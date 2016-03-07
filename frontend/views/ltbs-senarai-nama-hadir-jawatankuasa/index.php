<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'nama_penuh',
            'no_kad_pengenalan',
            'jawatan',
            //'jantina',
            //'kategori_keahlian',
            // 'kehadiran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
