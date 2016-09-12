<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AnugerahPencalonanLainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::anugerah_pencalonan_lain;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-lain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_pencalonan_lain, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'anugerah_pencalonan_lain_id',
            //'kategori',
            /*[
                'attribute' => 'kategori',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori,
                ],
                'value' => 'refKategoriPencalonanLain.desc'
            ],*/
            //'nama',
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ],
            ],
            //'gambar',
            //'no_kad_pengenalan',
            [
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ],
            ],
            // 'no_tel_1',
            [
                'attribute' => 'no_tel_1',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' No Telefon 1',
                ],
            ],
            // 'no_tel_2',
            // 'sumbangan_dalam_pencapaian:ntext',
            // 'ulasan_justifikasi:ntext',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
