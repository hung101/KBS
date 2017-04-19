<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefSubElemenBantuanPenganjuranKejohananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::sub_elemen_bantuan_penganjuran_kejohanan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-elemen-bantuan-penganjuran-kejohanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle.' '.GeneralLabel::sub_elemen_bantuan_penganjuran_kejohanan, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'ref_sub_elemen_bantuan_penganjuran_kejohanan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bantuan_penganjuran_kejohanan,
                ],
                'value' => 'refElemenBantuanPenganjuranKejohanan.desc',
            ],
            [
                'attribute' => 'desc',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::desc,
                ]
            ],
            //'aktif',
            [
                'attribute' => 'aktif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::aktif,
                ],
                'value' => function ($model) {
                    return $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
