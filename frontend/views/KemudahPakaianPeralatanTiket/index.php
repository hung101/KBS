<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KemudahPakaianPeralatanTiketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kemudahan Pakaian/Peralatan/Tiket Kapal Terbang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kemudah-pakaian-peralatan-tiket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kemudahan Pakaian/Peralatan/Tiket Kapal Terbang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kemudah_pakaian_peralatan_tiket_id',
            'atlet_id',
            'kategori_permohonan',
            'tarikh_diperlukan_pergi',
            'tarikh_dijangka_dipulangkan_balik',
            // 'destinasi_daripada',
            // 'destinasi_ke',
            // 'ulasan_permohonan',
            'kelulusan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
