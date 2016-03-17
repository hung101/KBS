<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanPenilaianKategoriJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Penilaian Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-kategori-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kategori Penilaian Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_penilaian_kategori_jurulatih_id',
            //'pengurusan_pemantauan_dan_penilaian_jurulatih_id',
            'penilaian_kategori',
            'penilaian_sub_kategori',
            'markah_penilaian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
