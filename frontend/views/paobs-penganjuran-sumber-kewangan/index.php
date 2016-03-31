<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PaobsPenganjuranSumberKewanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paobs Penganjuran Sumber Kewangans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paobs-penganjuran-sumber-kewangan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Paobs Penganjuran Sumber Kewangan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'paobs_penganjuran_sumber_kewangan_id',
            //'penganjuran_id',
            [
                'attribute' => 'sumber',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sumber,
                ]
            ],
            [
                'attribute' => 'jumlah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah,
                ]
            ],
            //'session_id',
            // ,
            // ,
            // ,
            // ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
