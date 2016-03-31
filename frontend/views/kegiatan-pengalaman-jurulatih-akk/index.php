<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KegiatanPengalamanJurulatihAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kegiatan/Pengalaman Sebagai Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-pengalaman-jurulatih-akk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kegiatan/Pengalaman Sebagai Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kegiatan_pengalaman_jurulatih_akk_id',
            //'akademi_akk_id',
            [
                'attribute' => 'nama_sukan_pertandingan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_sukan_pertandingan,
                ]
            ],
            [
                'attribute' => 'tahun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun,
                ]
            ],
            [
                'attribute' => 'peranan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::peranan,
                ]
            ],
            [
                'attribute' => 'peringkat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::peringkat,
                ]
            ],
            // 'persatuan_sukan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
