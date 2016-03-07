<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanProgramPendidikanPencegahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Program Pendidikan Pencegahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-pencegahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Permohonan Program Pendidikan Pencegahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'program_pendidikan_pencegahan_id',
            //'atlet_id_staff_id',
            'program',
            'tarikh_permohonan',
            'status_permohonan',
            // 'kategori_permohonan',
            // 'catitan_ringkas',
            // 'kelulusan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
