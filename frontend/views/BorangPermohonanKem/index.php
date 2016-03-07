<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorangPermohonanKemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Borang Permohonan Kem';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-permohonan-kem-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Borang Permohonan Kem', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'borang_permohonan_kem_id',
            'nama_program',
            'tarikh_program',
            'tempat',
            //'objektif',
            // 'cadangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
