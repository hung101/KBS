<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanPenilaianKategoriJurulatihKetuaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::kategori_penilaian_jurulatih;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-kategori-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle.' '.GeneralLabel::kategori_penilaian_jurulatih, ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_penilaian_kategori_jurulatih_id',
            //'pengurusan_pemantauan_dan_penilaian_jurulatih_id',
            [
                'attribute' => 'penilaian_kategori',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::penilaian_kategori,
                ]
            ],
            [
                'attribute' => 'penilaian_sub_kategori',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::penilaian_sub_kategori,
                ]
            ],
            [
                'attribute' => 'markah_penilaian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::markah_penilaian,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
