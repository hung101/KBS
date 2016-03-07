<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PemohonKursusTahapAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sains Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemohon-kursus-tahap-akk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Sains Sukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pemohon_kursus_tahap_akk_id',
            //'akademi_akk_id',
            'tahap',
            'tahun_lulus',
            'no_sijil',
            // 'kod_kursus',
            // 'tempat',
            // 'muatnaik_sijil',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
