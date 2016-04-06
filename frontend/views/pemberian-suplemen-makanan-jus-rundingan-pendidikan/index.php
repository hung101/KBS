<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PemberianSuplemenMakananJusRundinganPendidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pemberian_suplemenjus;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemberian-suplemen-makanan-jus-rundingan-pendidikan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pemberian Suplemen/Jus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pemberian_suplemen_makanan_jus_rundingan_pendidikan_id',
            //'perkhidmatan_permakanan_id',
            [
                'attribute' => 'nama_suplemen_makanan_jus_rundingan_pendidikan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_suplemen_makanan_jus_rundingan_pendidikan,
                ]
            ],
            [
                'attribute' => 'kuantiti_ml_g',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kuantiti_ml_g,
                ]
            ],
            [
                'attribute' => 'harga',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::harga,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
