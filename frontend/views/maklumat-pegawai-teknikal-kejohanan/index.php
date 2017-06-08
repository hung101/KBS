<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MaklumatPegawaiTeknikalKejohananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maklumat Pegawai Teknikal Kejohanans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-pegawai-teknikal-kejohanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Maklumat Pegawai Teknikal Kejohanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id',
            'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id',
            'nama_kejohanan_kursus',
            'tarikh_mula',
            'tarikh_tamat',
            // 'tempat',
            // 'program',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
