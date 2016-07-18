<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanPendidikanKeputusanSpmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Pendidikan Keputusan Spms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-keputusan-spm-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permohonan Pendidikan Keputusan Spm', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'permohonan_pendidikan_keputusan_spm_id',
            'permohonan_pendidikan_id',
            'subjek',
            'keputusan',
            'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
