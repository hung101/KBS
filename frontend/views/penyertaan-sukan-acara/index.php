<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenyertaanSukanAcaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::penyertaan_acara_sukan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-acara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::tambah_penyertaan_acara_sukan, ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penyertaan_sukan_acara_id',
            //'penyertaan_sukan_id',
            [
                'attribute' => 'nama_acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_acara,
                ]
            ],
            [
                'attribute' => 'tarikh_acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_acara,
                ]
            ],
            [
                'attribute' => 'keputusan_acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::keputusan_acara,
                ]
            ],
            // 'jumlah_pingat',
            // 'rekod_baru',
            // 'catatan_rekod_baru',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
