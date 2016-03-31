<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletKewanganPinjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pinjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-pinjaman-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pinjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pinjaman_id',
            //'atlet_id',
            [
                'attribute' => 'nama_bank',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_bank,
                ]
            ],
            [
                'attribute' => 'jenis_pinjaman',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_pinjaman,
                ]
            ],
            [
                'attribute' => 'no_akaun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_akaun,
                ]
            ],
            [
                'attribute' => 'nilai_pinjaman',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nilai_pinjaman,
                ]
            ],
            'tahun_pinjaman',
            // 'tahun_permulaan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
