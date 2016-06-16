<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKursusDisertaiPenceramahSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bantuan Penganjuran Kursus Disertai Penceramahs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-disertai-penceramah-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bantuan Penganjuran Kursus Disertai Penceramah', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penganjuran_kursus_disertai_penceramah_id',
            'bantuan_penganjuran_kursus_id',
            'kursus_seminar_bengkel',
            'tarikh',
            'tempat',
            // 'anjuran',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
