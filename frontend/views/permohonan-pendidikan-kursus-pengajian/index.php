<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanPendidikanKursusPengajianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Pendidikan Kursus Pengajians';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-kursus-pengajian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permohonan Pendidikan Kursus Pengajian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'permohonan_pendidikan_kursus_pengajian_id',
            'permohonan_pendidikan_id',
            'kursus_pengajian',
            'universiti',
            'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
