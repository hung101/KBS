<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPertukaranProgramPengajianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pertukaran Program Pengajian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_pertukaran_program_pengajian_id',
            //'bsp_pemohon_id',
            'tarikh',
            'bidang_pengajian_kursus',
            'fakulti',
            // 'tarikh_mula_pengajian',
            // 'tarikh_tamat_pengajian',
            // 'tempoh_perlanjutan_semester',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
