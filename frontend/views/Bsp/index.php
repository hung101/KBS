<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemohon Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pemohon Biasiswa Sukan Persekutuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_pemohon_id',
            //'atlet_id',
            [
                'attribute' => 'peringkat_pengajian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::peringkat_pengajian,
                ]
            ],
            [
                'attribute' => 'bidang_pengajian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bidang_pengajian,
                ]
            ],
            [
                'attribute' => 'falkuti_pengajian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::falkuti_pengajian,
                ]
            ],
            [
                'attribute' => 'ipt',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ipt,
                ]
            ],
            // 'tahun_mula_pengajian',
            // 'tahun_tamat_pengajian',
            // 'tahun_ditawarkan_biasiswa',
            // 'kelulusan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
