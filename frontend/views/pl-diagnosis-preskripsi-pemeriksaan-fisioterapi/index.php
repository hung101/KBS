<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlDiagnosisPreskripsiPemeriksaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::diagnosispreskripsipemeriksaanpenyiasatan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-diagnosis-preskripsi-pemeriksaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Diagnosis/Preskripsi/Pemeriksaan/Penyiasatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pl_diagnosis_preskripsi_pemeriksaan_id',
            //'pl_temujanji_id',
            [
                'attribute' => 'jenis_diagnosis_preskripsi_pemeriksaan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_diagnosis_preskripsi_pemeriksaan,
                ]
            ],
            [
                'attribute' => 'status_diagnosis_preskripsi_pemeriksaan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_diagnosis_preskripsi_pemeriksaan,
                ]
            ],
            //'catitan_ringkas',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
