<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CadanganElaunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadangan Elaun';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadangan-elaun-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Cadangan Elaun', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'cadangan_elaun_id',
            //'atlet',
            [
                'attribute' => 'elaun_semasa',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::elaun_semasa,
                ]
            ],
            [
                'attribute' => 'elaun_cadangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::elaun_cadangan,
                ]
            ],
            [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ]
            ],
             [
                'attribute' => 'tarikh_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat,
                ]
            ],
            // 'ulasan',
             [
                'attribute' => 'jenis_kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_kelulusan,
                ]
            ],
            // 'muat_naik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
