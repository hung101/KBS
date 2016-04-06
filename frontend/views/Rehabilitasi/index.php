<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RehabilitasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::rehabilitasi;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Rehabilitasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'rehabilitasi_id',
            //'pl_diagnosis_preskripsi_pemeriksaan_id',
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],
            [
                'attribute' => 'kesan_klinikal',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kesan_klinikal,
                ]
            ],
            [
                'attribute' => 'masalah_yang_dikenal_pasti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::masalah_yang_dikenal_pasti,
                ]
            ],
            // 'potensi_rehabilitasi',
            // 'matlamat_rehabilitasi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
