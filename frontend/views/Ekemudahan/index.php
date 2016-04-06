<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EkemudahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::ekemudahan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ekemudahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah e-Kemudahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ekemudahan_id',
            [
                'attribute' => 'kategori',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori,
                ]
            ],
            [
                'attribute' => 'jenis',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis,
                ]
            ],
            //'gambar',
            [
                'attribute' => 'lokasi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::lokasi,
                ]
            ],
            [
                'attribute' => 'dihubungi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::dihubungi,
                ]
            ],
            // 'kadar_sewa',
            // 'url:url',
            // 'nama_perniagaan_perkhidmatan_organisasi',
            // 'kapasiti_penggunaan',
            // 'no_lesen_pendaftaran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
