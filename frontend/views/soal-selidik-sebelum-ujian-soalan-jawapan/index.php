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

            'soal_selidik_sebelum_ujian_soalan_jawapan_id',
            'soal_selidik_sebelum_ujian_id',
            'soalan',
            'jawapan',

            // ,
            // ,
            // ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
