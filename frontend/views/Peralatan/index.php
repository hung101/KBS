<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PeralatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peralatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peralatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Peralatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'peralatan_id',
            //'permohonan_peralatan_id',
            [
                'attribute' => 'nama_peralatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_peralatan,
                ]
            ],
            [
                'attribute' => 'spesifikasi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::spesifikasi,
                ]
            ],
            [
                'attribute' => 'kuantiti_unit',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kuantiti_unit,
                ]
            ],
            // 'catatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
