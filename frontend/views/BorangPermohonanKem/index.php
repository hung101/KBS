<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorangPermohonanKemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::borang_permohonan_kem;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-permohonan-kem-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Borang Permohonan Kem', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'borang_permohonan_kem_id',
            [
                'attribute' => 'nama_program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_program,
                ]
            ],
            [
                'attribute' => 'tarikh_program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_program,
                ]
            ],
            [
                'attribute' => 'tempat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tempat,
                ]
            ],
            //'objektif',
            // 'cadangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
