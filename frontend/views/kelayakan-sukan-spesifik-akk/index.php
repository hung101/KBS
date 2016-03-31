<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KelayakanSukanSpesifikAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelayakan Sukan Spesifik AKK';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelayakan-sukan-spesifik-akk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kelayakan Sukan Spesifik AKK', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kelayakan_sukan_spesifik_akk_id',
            //'akademi_akk_id',
            [
                'attribute' => 'nama_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_kursus,
                ]
            ],
            [
                'attribute' => 'tahap',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahap,
                ]
            ],
            [
                'attribute' => 'tahun_lulus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_lulus,
                ]
            ],
            // 'persatuan_sukan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
