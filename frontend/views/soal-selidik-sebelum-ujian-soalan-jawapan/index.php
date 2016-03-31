<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SoalSelidikSebelumUjianSoalanJawapanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soal Selidik Sebelum Ujian Soalan Jawapans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-soalan-jawapan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Soal Selidik Sebelum Ujian Soalan Jawapan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'soal_selidik_sebelum_ujian_soalan_jawapan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::soal_selidik_sebelum_ujian_soalan_jawapan_id,
                ]
            ],
            [
                'attribute' => 'soal_selidik_sebelum_ujian_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::soal_selidik_sebelum_ujian_id,
                ]
            ],
            [
                'attribute' => 'soalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::soalan,
                ]
            ],
            [
                'attribute' => 'jawapan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawapan,
                ]
            ],

            // ,
            // ,
            // ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
