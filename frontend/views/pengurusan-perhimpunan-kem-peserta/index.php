<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanPerhimpunanKemPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Perhimpunan/Kem Peserta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhimpunan-kem-peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengurusan Perhimpunan/Kem Peserta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_perhimpunan_kem_peserta_id',
            //'pengurusan_perhimpunan_kem_id',
            [
                'attribute' => 'nama_peserta',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_peserta,
                ]
            ],
            [
                'attribute' => 'kategori_peserta',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_peserta,
                ]
            ],
            [
                'attribute' => 'jawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
