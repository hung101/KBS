<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanDokumenMediaProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Dokumen Media Program';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-dokumen-media-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengurusan Dokumen Media Program', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_dokumen_media_program_id',
            //'pengurusan_media_program_id',
            'kategori_dokumen',
            'nama_dokumen',
            'muatnaik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
