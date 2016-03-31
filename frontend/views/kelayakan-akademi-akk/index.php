<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KelayakanAkademiAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelayakan Akademi AKK';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelayakan-akademi-akk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kelayakan Akademi AKK', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kelayakan_akademi_akk_id',
            //'akademi_akk_id',
            [
                'attribute' => 'nama_peperiksaan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_peperiksaan,
                ]
            ],
            [
                'attribute' => 'tahun',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun,
                ]
            ],
            [
                'attribute' => 'keputusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::keputusan,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
