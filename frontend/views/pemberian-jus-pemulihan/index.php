<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PemberianJusPemulihanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemberian Jus Pemulihans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemberian-jus-pemulihan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemberian Jus Pemulihan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pemberian_jus_pemulihan_id',
            //'perkhidmatan_permakanan_id',
            //'kategori_atlet',
            //'sukan',
            //'acara',
            // 'atlet',
            'nama_jus',
            // 'jenis_jus',
            'kuantiti',
            // 'berat_badan',
            // 'buah',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
