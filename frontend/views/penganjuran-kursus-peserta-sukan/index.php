<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenganjuranKursusPesertaSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penganjuran Kursus Peserta Sukans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-sukan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Penganjuran Kursus Peserta Sukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'penganjuran_kursus_peserta_sukan_id',
            [
                'attribute' => 'penganjuran_kursus_peserta_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::penganjuran_kursus_peserta_id,
                ]
            ],
            [
                'attribute' => 'jenis_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_sukan,
                ]
            ],
            [
                'attribute' => 'tahap',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahap,
                ]
            ],
            [
                'attribute' => 'tahun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun,
                ]
            ],
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
